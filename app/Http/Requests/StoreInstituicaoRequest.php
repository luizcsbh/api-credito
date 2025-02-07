<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstituicaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'codigo' => 'required|integer|unique:instituicoes,codigo'
        ];
    }

        /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatório.',
            'nome.string' => 'O campo :attribute deve ser uma string.',
            'nome.min' => 'O campo :attribute precisa no minimo 3 caracteres.',
            'nome.max' => 'O campo :attribute não pode ter mais que 255 caracteres.',
            'codigo.required' => 'O campo :attribute é obrigatório.',
            'codigo.integer' => 'O campo :attribute deve ser um número inteiro.',
            'codigo.unique' => 'O :attribute informado já está em uso.'
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
