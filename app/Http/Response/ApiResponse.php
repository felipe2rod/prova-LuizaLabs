<?php
namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

Class ApiResponse{

	public function sendResponse($result)
	{
		$response = [
            'success' => true,
            'data'    => $result
        ];
        return response()->json($response, JsonResponse::HTTP_CREATED);
	}

	public function sendError($error, $errorMessages = [], $code = JsonResponse::HTTP_NOT_FOUND)
	{
		$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
	}
}