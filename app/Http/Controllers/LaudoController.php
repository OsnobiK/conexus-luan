<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Laudo;
use Illuminate\Support\Facades\Auth; 
use App\Models\LaudoPendente;
 
class LaudoController extends Controller
{
    public function create()
    {
        return view('cadastralaudo');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:120',
            'data-nascimento' => 'required|date',
            'rg' => 'required|string|max:10',
            'cpf' => 'required|string|max:11', // CPF sem pontuação
            'medico' => 'required|string|max:120',
            'crm' => 'required|string|max:10',
            'especialidade' => 'required|string|max:120',
            'contato-medico' => 'required|string|max:15',
            'detalhes' => 'required|string|max:1000',
            'diagnostico' => 'required|string|max:120',
            'arquivo-pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);
 
        $path = null;
        if ($request->hasFile('arquivo-pdf')) {
            $path = $request->file('arquivo-pdf')->store('laudos', 'public');
        }
 
        Laudo::create([
            'nome' => $validated['nome'],
            'data_nascimento' => $validated['data-nascimento'],
            'rg' => $validated['rg'],
            'cpf' => $validated['cpf'],
            'medico' => $validated['medico'],
            'crm' => $validated['crm'],
            'especialidade' => $validated['especialidade'],
            'contato_medico' => $validated['contato-medico'],
            'detalhes' => $validated['detalhes'],
            'diagnostico' => $validated['diagnostico'],
            'arquivo_pdf' => $path,
            'usuario_id' => Auth::id(),
            'condicao' => 'pendente',
            // 'sala_id' => $validated['sala_id'], // descomente se necessário
        ]);
 
        return redirect()->route('cadastrarlaudo')->with('success', 'Laudo cadastrado com sucesso!');
    }
}
