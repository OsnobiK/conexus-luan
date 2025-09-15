<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- IMPORTANTE: Importe o model User (ou Usuario)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- IMPORTANTE: Importe a classe Hash
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception; // Importa a classe Exception para o bloco catch

class CadastroController extends Controller
{
    /**
     * Exibe o formulário de cadastro.
     * O nome do método foi alterado de create() para showRegistrationForm()
     * para seguir as convenções do Laravel e evitar conflito de nomes.
     */
    public function showRegistrationForm()
    {
        return view('cadastro');
    }

    /**
     * Lida com a submissão do formulário de cadastro.
     * Valida os dados e cria um novo usuário.
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados
        $this->validator($request->all())->validate();

        try {
            // 2. Criação do usuário
            $usuario = $this->createUser($request->all());

            // 3. Login do novo usuário
            Auth::login($usuario);

            // 4. Redirecionamento com mensagem de sucesso
            return redirect()->route('perfil.show')->with('success', 'Cadastro realizado com sucesso!');

        } catch (Exception $e) {
            // Em caso de erro, registra o erro detalhado no log
            Log::error('Erro ao cadastrar usuário: ' . $e->getMessage());

            // Retorna para o formulário anterior com os dados preenchidos e uma mensagem de erro amigável
            return back()->withInput()->withErrors(['cadastro' => 'Não foi possível realizar o cadastro. Por favor, tente novamente mais tarde.']);
        }
    }

    /**
     * Valida os dados de entrada para o registro de um novo usuário.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // Certifique-se que 'usuarios' é o nome correto da sua tabela no banco de dados
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['user', 'medico'])],
        ]);
    }

    /**
     * Cria uma nova instância de usuário após uma validação bem-sucedida.
     * O nome do método foi alterado de create() para createUser()
     * para evitar conflito com o método que exibe o formulário.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createUser(array $data)
    {
        // Certifique-se de que está usando o Model correto (User ou Usuario)
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }
}