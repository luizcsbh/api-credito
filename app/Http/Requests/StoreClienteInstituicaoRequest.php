<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteInstituicaoRequest extends FormRequest
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
            'cliente_id' => 'required|integer|exists:clientes,id',
            'instituicao_id' => 'required|integer|exists:instituicoes,id',
        ];
    }

    /**
     * Get the validation messages for the defined rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'cliente_id.required' => 'O campo :attribute é obrigatório.',
            'cliente_id.integer' => 'O :attribute deve ser um número inteiro.',
            'cliente_id.exists' => 'O :attribute informado não existe no sistema.',
            'instituicao_id.required' => 'O campo :attribute é obrigatório.',
            'instituicao_id.integer' => 'O :attribute deve ser um número inteiro.',
            'instituicao_id.exists' => 'O :attribute informada não existe no sistema.',
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
            'cliente_id' => 'identificador do cliente',
            'instituicao_id' => 'identificador da instituição',
        ];
    }
}
