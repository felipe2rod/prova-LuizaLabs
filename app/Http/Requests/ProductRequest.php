<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseAPIFormRequest;


class ProductRequest extends BaseAPIFormRequest
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
     * @return array
     */
    public function rules()
    {
        $RequiredOnlyCreate = ($this->id ? '' : 'required|');
        return [
            'name' => "{$RequiredOnlyCreate}string|max:45",
            'color' => "{$RequiredOnlyCreate}string|max:15",
            'size' => "{$RequiredOnlyCreate}string|max:15",
            'price'=> "{$RequiredOnlyCreate}numeric"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'name.max' => "O campo nome deve ter no maximo 45 caracteres",
            'name.string' => "O campo nome deve ser uma string",

            'color.required' => "O campo cor é obrigatório",
            'color.max' => "O campo cor deve ter 15 caracteres",
            'color.string' => "O campo cor deve ser uma string",

            'size.required' => "O campo tamanho é obrigatório",
            'size.max' => "O campo tamanho deve ter 15 caracteres",
            'size.string' => "O campo tamanho deve ser uma string",

            'price.required' => "O campo preço é obrigatório",
            'price.numeric' => "O campo preço deve ser um numero",
        ];
    }
}
