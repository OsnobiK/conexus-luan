<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\LaudoPendente; // Importar o modelo LaudoPendente
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Middleware de Autenticação
    |--------------------------------------------------------------------------
    |
    | O construtor com middleware foi removido. A forma moderna e correta
    | de proteger rotas é no ficheiro `routes/web.php`, envolvendo as
    | rotas do SalaController num `Route::middleware(['auth'])->group(...)`.
    |
    */

    /**
     * Exibe a lista de salas disponíveis para agendamento.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        $salas = Sala::with('agendamentos')
            // Garante que só apareçam salas cujo horário ainda não passou
            ->whereRaw("CONCAT(data, ' ', hora) > ?", [now()->addMinutes(10)])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tema', 'like', "%{$search}%")
                      ->orWhere('nome_medico', 'like', "%{$search}%");
                });
            })
            ->get();

        // Verifica se o usuário tem um laudo (assumindo que o método temLaudo() existe no seu modelo Usuario)
        $temLaudo = $user->temLaudo();
        
        return view('salas', compact('salas', 'temLaudo'));
    }

    /**
     * Exibe o formulário de criação de uma nova sala.
     * (Apenas para médicos)
     */
    public function create()
    {
        return view('criar-salas');
    }

    /**
     * Armazena uma nova sala no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer|min:2|max:8',
            'nome_medico' => 'required|string|max:255',
            'laudo' => 'required|in:sim,nao', // Renomeado para corresponder ao formulário
        ]);

        // Converte o valor 'sim'/'nao' para booleano (1/0)
        $laudoObrigatorio = $request->laudo === 'sim' ? 1 : 0;

        Sala::create([
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'numero_participantes' => $request->numero_participantes,
            'nome_medico' => $request->nome_medico,
            'laudo_obrigatorio' => $laudoObrigatorio, // <-- CORREÇÃO APLICADA
            'usuario_id' => auth()->user()->id,
        ]);

        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso!');
    }

    /**
     * Exibe o formulário para editar uma sala existente.
     */
    public function edit($id)
    {
        $sala = Sala::findOrFail($id);

        // Garante que apenas o médico que criou a sala pode editá-la
        if ($sala->usuario_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('criar-salas', compact('sala'));
    }

    /**
     * Atualiza uma sala existente no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $sala = Sala::findOrFail($id);

        // Garante que apenas o médico que criou a sala pode atualizá-la
        if ($sala->usuario_id !== auth()->id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'tema' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer|min:2|max:8',
            'nome_medico' => 'required|string|max:255',
            'laudo' => 'required|in:sim,nao',
        ]);

        $laudoObrigatorio = $request->laudo === 'sim' ? 1 : 0;

        $sala->update([
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'numero_participantes' => $request->numero_participantes,
            'nome_medico' => $request->nome_medico,
            'laudo_obrigatorio' => $laudoObrigatorio, // <-- CORREÇÃO APLICADA
        ]);

        return redirect()->route('salas.criadas')->with('success', 'Sala atualizada com sucesso!');
    }

    /**
     * Realiza o agendamento de um usuário numa sala.
     */
    public function agendar(Request $request, $id)
    {
        $user = auth()->user();
        $sala = Sala::findOrFail($id);

        // Verifica se a sala já está cheia
        if ($sala->agendamentos()->count() >= $sala->numero_participantes) {
            return back()->with('error', 'Esta sala já atingiu o limite de participantes.');
        }

        // Verifica se o usuário já está agendado
        if ($user->salas()->where('sala_id', $sala->id)->exists()) {
            return back()->with('error', 'Você já está agendado para esta sala.');
        }
        
        // Se a sala exige laudo
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

        // Se não exige laudo, agenda diretamente
        $user->salas()->attach($sala->id);

        return back()->with('success', 'Agendamento realizado com sucesso!');
    }

    /**
     * Exibe as salas que o usuário (paciente) agendou.
     */
    public function salasAgendadas()
    {
        $salas = auth()->user()->salas()
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('salas.espera-de-salas', compact('salas'));
    }

    /**
     * Exibe as salas que o médico criou.
     */
    public function minhasSalas()
    {
        $salas = Sala::where('usuario_id', auth()->id())
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('salas-criadas', compact('salas'));
    }
}
