<?php


namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    // Método para exibir o formulário de criação da sala
    public function create()
    {
        return view('salas.create');  // Certifique-se de que a view 'create.blade.php' exista em resources/views/salas/
    }

    // Método para salvar a nova sala no banco
    public function store(Request $request)
    {
        // Validação e criação da sala...
        Sala::create([
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'numero_participantes' => $request->numero_participantes,
            'nome_medico' => $request->nome_medico,
            'laudo_obrigatorio' => $request->laudo === 'sim' ? 1 : 0,
        ]);

        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso!');
    }
}
