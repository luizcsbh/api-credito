<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstituicaoRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação da request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'sometimes|required|string|min:3|max:255',
            'codigo' => 'sometimes|required|integer|unique:instituicoes,codigo,' . $this->route('instituicao'),
        ];
    }

    /**
     * Mensagens de erro personalizadas para a validação.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatório.',
            'nome.string' => 'O campo :attribute deve ser um texto.',
            'nome.min' => 'O campo :attribute precisa ter pelo menos 3 caracteres.',
            'nome.max' => 'O campo :attribute não pode ter mais que 255 caracteres.',
            'codigo.required' => 'O campo :attribute é obrigatório.',
            'codigo.integer' => 'O campo :attribute deve ser um número inteiro.',
            'codigo.unique' => 'O :attribute informado já está em uso por outra instituição.',
        ];
    }

    /**
     * Define os nomes personalizados dos atributos.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'nome' => 'Nome da instituição',
            'codigo' => 'Código da instituição',
        ];
    }
}
