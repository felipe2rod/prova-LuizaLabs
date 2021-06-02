<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseAPIFormRequest;


class OrderRequest extends BaseAPIFormRequest
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
            'order_date' => "{$RequiredOnlyCreate}date",
            'observation' => "{$RequiredOnlyCreate}string",
            'pay_method' => "{$RequiredOnlyCreate}in:money,credit_card,check",
            'client_id'=> "{$RequiredOnlyCreate}exists:clients,id",
            'items.*.quantity' => "{$RequiredOnlyCreate}numeric",
            'items.*.product_id' => "{$RequiredOnlyCreate}exists:products,id"
        ];
    }

    public function messages()
    {
        return [
            'order_date.required' => "O campo data é obrigatório",
            'order_date.date' => "O campo data tem um formato invalido",

            'observation.required' => "O campo observação é obrigatório",
            'observation.string' => "O campo observação deve ser uma string",

            'pay_method.required' => "O campo pagamento é obrigatório",
            'pay_method.in' => "O campo pagamento é invalido",

            'client_id.required' => "O campo cliente é obrigatório",
            'client_id.exists' => "O cliente informado não existe",

            'items.*.quantity.required' =>'A quantidade de itens no pedido é obrigatório',
            'items.*.quantity.numeric' =>'A quantidade de itens no pedido deve ser um numero',
            
            'items.*.product_id.required' =>'O produto no pedido é obrigatório',
            'items.*.product_id.exists' =>'O produto informado no pedido não existe',
        ];
    }
}
