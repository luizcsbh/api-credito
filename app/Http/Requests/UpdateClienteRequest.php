<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
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
            'nome' => 'sometimes|required|string|max:255',
            'cpf' => 'sometimes|required|string|max:14|unique:clientes,cpf',
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
            'nome.max' => 'O campo :attribute não pode ter mais de 255 caracteres.',
            'cpf.required' => 'O campo :attribute é obrigatório.',
            'cpf.string' => 'O campo :attribute deve ser um texto.',
            'cpf.max' => 'O campo :attribute não pode ter mais de 14 caracteres.',
            'cpf.unique' => 'Este :attribute já está cadastrado.',
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
            'nome' => 'nome',
            'cpf' => 'CPF',
        ];
    }
}
