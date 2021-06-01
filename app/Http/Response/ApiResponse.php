<?php
namespace App\Http\Response;

Class ApiResponse{

	public function sendResponse($result)
	{
		$response = [
            'success' => true,
            'data'    => $result
        ];
        return response()->json($response, Response::HTTP_CREATED);
	}

	public function sendError($error, $errorMessages = [], $code = Response::HTTP_NOT_FOUND)
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