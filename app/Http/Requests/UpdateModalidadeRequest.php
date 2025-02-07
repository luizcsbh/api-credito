<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModalidadeRequest extends FormRequest
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
            'instituicao_id' => 'sometimes|required|exists:instituicoes,id',
            'credito_taxas_id' => 'sometimes|required|exists:credito_taxas,id',
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
            'instituicao_id.required' => 'O campo :attribute é obrigatório.',
            'instituicao_id.exists' => 'A instituição selecionada não existe.',
            'credito_taxas_id.required' => 'O campo :attribute é obrigatório.',
            'credito_taxas_id.exists' => 'A taxa de crédito selecionada não existe.',
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
