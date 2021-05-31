<?php

namespace App\Http\Controllers;

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

}
