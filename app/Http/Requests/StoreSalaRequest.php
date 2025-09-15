<?php 
// app/Http/Requests/StoreSalaRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Para a criação, qualquer usuário autenticado pode criar.
        // Se houver uma regra específica (ex: só médicos), implemente aqui.
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'tema' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer|min:2|max:8',
            'nome_medico' => 'required|string|max:255',
            'laudo' => 'required|in:sim,nao',
        ];
    }

    /**
     * Prepara os dados para armazenamento.
     */
    public function getData(): array
    {
        return [
            'tema' => $this->tema,
            'descricao' => $this->descricao,
            'data' => $this->data,
            'hora' => $this->hora,
            'numero_participantes' => $this->numero_participantes,
            'nome_medico' => $this->nome_medico,
            'laudo_obrigatorio' => $this->laudo === 'sim' ? 1 : 0,
            'usuario_id' => auth()->id(),
        ];
    }
}