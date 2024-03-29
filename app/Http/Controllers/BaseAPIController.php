<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Http\Response\ApiResponse as ApiResponse;
use Illuminate\Http\JsonResponse;

class BaseAPIController extends Controller 
{
    private $ApiResponse = null;

    public function __construct(){
        $this->ApiResponse = new ApiResponse();
    }

	public function sendResponse($result){
        return $this->ApiResponse->sendResponse($result);
    }

    public function sendError($error, $errorMessages = [], $code = JsonResponse::HTTP_NOT_FOUND){
        return $this->ApiResponse->sendError($error, $errorMessages, $code);
    }
}