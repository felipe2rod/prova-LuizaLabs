<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use App\Http\Response\ApiResponse as ApiResponse;


abstract class BaseAPIFormRequest extends LaravelFormRequest
{
    private $ApiResponse = null;

    public function __construct(){
        $this->ApiResponse = new ApiResponse();
    }
   
    abstract public function rules();

 
    abstract public function authorize();


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            $this->ApiResponse->sendError("Validation failed", $errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
