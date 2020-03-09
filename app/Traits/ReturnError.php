<?php
namespace App\Traits;
use App\Http\Resources\ErrorResponse as ErrorResponseResource;

trait ReturnError {

    public function errorResponse($status, $message)
    {
        $response = array("code"=>$status, "message"=>$message);

        return new ErrorResponseResource($response);

    }


}
