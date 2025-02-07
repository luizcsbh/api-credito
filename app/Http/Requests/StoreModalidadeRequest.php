<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModalidadeRequest extends FormRequest
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
            'instituicao_id' => 'required|exists:instituicoes,id',
            'credito_taxas_id' => 'required|exists:credito_taxas,id',
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
           'instituicao_id.required' => 'O campo :attribute é obrigatório.',
            'instituicao_id.exists' => 'A :attribute selecionada não existe.',
            'credito_taxas_id.required' => 'O campo :attribute é obrigatório.',
            'credito_taxas_id.exists' => 'A :attribute selecionada não existe.',
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
            'instituicao_id' => 'instituição',
            'credito_taxas_id' => 'taxa de crédito',
        ];
    }
}
