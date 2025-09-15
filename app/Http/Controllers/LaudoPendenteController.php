<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\LaudoPendente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // SUGESTÃO: Importar DB para transações

class SalaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // SUGESTÃO: Query otimizada para performance
        $salas = Sala::with('agendamentos')
            ->where(function ($query) {
                $now = now()->addMinutes(10);
                $query->where('data', '>', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->where('data', '=', $now->toDateString())
                          ->where('hora', '>', $now->toTimeString());
                    });
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tema', 'like', "%{$search}%")
                      ->orWhere('nome_medico', 'like', "%{$search}%");
                });
            })
            ->get();

        // PONTO DE ATENÇÃO: Verifique se a view realmente precisa desta variável.
        // A lógica de bloqueio está no agendamento, o que é o correto.
        $temLaudo = $user->temLaudo();
        
        return view('salas', compact('salas', 'temLaudo'));
    }

    public function create()
    {
        return view('criar-salas');
    }

    // SUGESTÃO: Usar um Form Request (ex: StoreSalaRequest) para mover a validação
    // e simplificar o controller.
    public function store(Request $request) 
    {
        // A validação seria movida para StoreSalaRequest
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer|min:2|max:8',
            'nome_medico' => 'required|string|max:255',
            'laudo' => 'required|in:sim,nao',
        ]);

        $validated['laudo_obrigatorio'] = $request->laudo === 'sim' ? 1 : 0;
        $validated['usuario_id'] = auth()->id();

        Sala::create($validated);

        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso!');
    }

    public function edit($id)
    {
        $sala = Sala::findOrFail($id);

        // SUGESTÃO: Esta lógica pode ser movida para a função `authorize()`
        // de um Form Request (ex: UpdateSalaRequest). Isso é chamado de "Policies" ou
        // "Form Request Authorization".
        if ($sala->usuario_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('criar-salas', compact('sala'));
    }

    // SUGESTÃO: Também usar um Form Request aqui (ex: UpdateSalaRequest)
    public function update(Request $request, $id)
    {
        $sala = Sala::findOrFail($id);

        // A autorização ficaria no Form Request
        if ($sala->usuario_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            // ... mesmas regras do store
            'laudo' => 'required|in:sim,nao',
        ]);
        
        $validated['laudo_obrigatorio'] = $request->laudo === 'sim' ? 1 : 0;

        $sala->update($validated);

        return redirect()->route('salas.criadas')->with('success', 'Sala atualizada com sucesso!');
    }

    // SUGESTÃO: Envolver a lógica em uma transação de DB para garantir a
    // integridade dos dados e prevenir race conditions.
    public function agendar(Request $request, $id)
    {
        $user = auth()->user();

        try {
            return DB::transaction(function () use ($request, $id, $user) {
                $sala = Sala::where('id', $id)->lockForUpdate()->firstOrFail();

                if ($sala->agendamentos()->count() >= $sala->numero_participantes) {
                    return back()->with('error', 'Esta sala já atingiu o limite de participantes.');
                }

                if ($user->salas()->where('sala_id', $sala->id)->exists()) {
                    return back()->with('error', 'Você já está agendado para esta sala.');
                }
                
                if ($sala->laudo_obrigatorio) {
                    $request->validate([
                        'laudo' => 'required|file|mimes:pdf|max:2048',
                    ], [
                        'laudo.required' => 'É necessário anexar o laudo em PDF para esta sala.'
                    ]);

                    $path = $request->file('laudo')->store('laudos', 'public');

                    LaudoPendente::create([
                        'user_id' => $user->id,
                        'sala_id' => $sala->id,
                        'condicao' => 'pendente',
                        'caminho_arquivo' => $path,
                    ]);

                    return back()->with('success', 'Laudo enviado para análise. O seu agendamento ficará pendente de aprovação.');
                }

                $user->salas()->attach($sala->id);

                return back()->with('success', 'Agendamento realizado com sucesso!');
            });
        } catch (\Exception $e) {
            // Logar o erro, se necessário
            return back()->with('error', 'Ocorreu um erro inesperado ao tentar agendar. Tente novamente.');
        }
    }

    public function salasAgendadas()
    {
        $salas = auth()->user()->salas()
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('salas.espera-de-salas', compact('salas'));
    }

    public function minhasSalas()
    {
        $salas = Sala::where('usuario_id', auth()->id())
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('salas-criadas', compact('salas'));
    }
}