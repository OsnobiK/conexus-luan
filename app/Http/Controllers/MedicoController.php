<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CreatesNewUsers; // Importa o Trait
use Illuminate\Http\Request;
use App\Models\Medico;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MedicoController extends Controller
{
    use CreatesNewUsers; // "Usa" o Trait que contém a lógica de criar usuário

    /**
     * Mostra o formulário de cadastro de médico.
     */
    public function create()
    {
        return view('cadastromedico');
    }

    /**
     * Salva o novo médico e seu usuário correspondente.
     */
    public function store(Request $request)
    {
        // 1. Valida os campos que vêm do formulário, incluindo 'nome'.
        $request->validate([
            'nome' => ['required', 'string', 'max:255'], // Validamos o campo 'nome' que vem do formulário
            'especialidade' => ['required', 'string', 'max:100'],
            'crm' => ['required', 'string', 'max:20', 'unique:medicos,crm'],
        ]);

        // Usamos uma transação para garantir que, se algo der errado, nada seja salvo.
        DB::beginTransaction();
        try {
            // 2. 👇 CORREÇÃO AQUI: "Traduzimos" o campo 'nome' para 'name' para o Trait entender.
            // O método merge adiciona ou substitui um valor na requisição atual.
            $request->merge(['name' => $request->nome]);

            // 3. Chama o método do Trait, que agora receberá o campo 'name' corretamente.
            $usuario = $this->createUser($request);

            // 4. Cria o perfil de MÉDICO com os dados específicos.
            Medico::create([
                'usuario_id' => $usuario->id,
                'especialidade' => $request->especialidade,
                'crm' => $request->crm,
            ]);

            // Se chegou até aqui, tudo deu certo. Confirma as operações no banco.
            DB::commit();

            // Faz o login do novo usuário/médico.
            Auth::login($usuario);

            // Redireciona com uma mensagem de sucesso.
            return redirect()->route('perfil.show')->with('success', 'Cadastro de médico realizado com sucesso!');
            
        } catch (\Exception $e) {
            // Se qualquer erro acontecer, desfaz todas as operações do banco.
            DB::rollBack();
            
            // Para depuração, você pode descomentar a linha abaixo para ver o erro exato:
            // dd($e->getMessage());

            return back()->with('error', 'Houve um erro ao realizar o cadastro. Por favor, tente novamente.')->withInput();
        }
    }
}
