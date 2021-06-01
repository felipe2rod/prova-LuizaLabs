<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseAPIFormRequest;


class ClientRequest extends BaseAPIFormRequest
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
        return [
            'name' => 'required|string|max:45',
            'cpf' => 'required|string|max:14|min:14|unique:clients,cpf'.($this->id ? ','.$this->id : ''),
            'email' => 'required|string|max:45|unique:clients,email'.($this->id ? ','.$this->id : ''),
            'sex'=> 'required|in:male,female',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O campo nome é obrigatório",
            'name.max' => "O campo nome deve ter no maximo 45 caracteres",
            'name.string' => "O campo nome deve ser uma string",

            'cpf.required' => "O campo cpf é obrigatório",
            'cpf.max' => "O campo cpf deve ter 14 caracteres",
            'cpf.min' => "O campo cpf deve ter 14 caracteres",
            'cpf.string' => "O campo cpf deve ser uma string",
            'cpf.unique' => "O cpf informado ja foi cadastrado",

            'email.required' => "O campo email é obrigatório",
            'email.max' => "O campo email deve ter no maximo 45 caracteres",
            'email.string' => "O campo email deve ser uma string",
            'email.unique' => "O email informado ja foi cadastrado",


            'sex.required' => "O campo sexo é obrigatório",
            'sex.in' => "O sexo informado é invalido",
        ];
    }
}
