<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Controllers\BaseAPIController as BaseAPIController;
use App\Http\Resources\Client as ClientResource;



class ClientController extends BaseAPIController
{
    public function index()
    {
        $Clients = Client::all();
        return $this->sendResponse(ClientResource::collection($Clients));
    }

    public function create(ClientRequest $request)
    {
        try{
            Client::create($request->all());
            return $this->sendResponse("Successfully created");
        }catch(Exception $e){
            return $this->sendError("create error", ['meta' => $e->getMessage()], Response::HTTP_ERROR);
        }
        
    }

    public function show( $id ){
        try{
            $Client = Client::findOrFail($id);
            return $this->sendResponse(new ClientResource($Client));
        }catch(ModelNotFoundException $e){
            return $this->sendError("get error", ['meta' => $e->getMessage()]);

        }
    }

}
