<?php

namespace App\Http\Controllers\Traits;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

trait CreatesNewUsers
{
    /**
     * Valida e cria um novo registro de usuário.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Usuario
     */
    protected function createUser(Request $request): Usuario
    {
        // Validação dos dados comuns do usuário
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:14', 'unique:usuarios,cpf'],
            'telefone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Criação do usuário
        return Usuario::create([
            'name'      => $request->name,
            'cpf'       => $request->cpf,
            'telefone'  => $request->telefone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
    }
}
