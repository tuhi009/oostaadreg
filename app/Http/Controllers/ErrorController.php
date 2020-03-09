<?php

namespace App\Http\Controllers;

use App\Http\Resources\ErrorResponse as ErrorResponseResource;
use Illuminate\Http\Request;



class ErrorController extends Controller
{
    public function boot()
    {

    }

    public function errorResponse($status, $message)
    {
       // Resource::withoutWrapping();

        $response = array("Status"=>$status, "Message"=>$message);

        return new ErrorResponseResource($response);
    }
}
