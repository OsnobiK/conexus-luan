<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest // <<-- MUDANÇA AQUI
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Deve ser 'true' para permitir que a validação ocorra.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'min:11', 'max:14', 'unique:usuarios'], // <<-- MUDANÇA: adicionado CPF, unique:usuarios
            'telefone' => ['required', 'string', 'min:14', 'max:15'], // <<-- MUDANÇA: adicionado Telefone
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios', 'regex:/^[A-Za-z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'], // <<-- MUDANÇA: unique:usuarios
            'senha' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'], // <<-- MUDANÇA: nome do campo 'senha'
            'confirmar-senha' => ['required', 'string', 'same:senha'], // <<-- MUDANÇA: 'same:senha' para validar confirmação
            'termos' => ['required', 'accepted'], // <<-- MUDANÇA: validação dos termos
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais de :max caracteres.',

            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser uma string.',
            'cpf.min' => 'O CPF deve ter no mínimo :min caracteres.',
            'cpf.max' => 'O CPF não pode ter mais de :max caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.string' => 'O telefone deve ser uma string.',
            'telefone.min' => 'O telefone deve ter no mínimo :min caracteres.',
            'telefone.max' => 'O telefone não pode ter mais de :max caracteres.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O e-mail deve ser uma string.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.max' => 'O e-mail não pode ter mais de :max caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',
            'email.regex' => 'O formato do e-mail é inválido.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'A senha deve ser uma string.',
            'senha.min' => 'A senha deve ter no mínimo :min caracteres.',
            'senha.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.',

            'confirmar-senha.required' => 'O campo confirmar senha é obrigatório.',
            'confirmar-senha.string' => 'A confirmação de senha deve ser uma string.',
            'confirmar-senha.same' => 'A confirmação de senha não corresponde à senha.',

            'termos.required' => 'Você deve aceitar os Termos de Serviço.',
            'termos.accepted' => 'Você deve aceitar os Termos de Serviço.',
        ];
    }
}