<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountInfo;
use App\Http\Resources\AccountInfo as AccountInfoResource;

class RegistrationController extends Controller
{


    public function store(Request $request)
    {

        if ($request->isMethod('post')) {

            $emailResponse = $this->verifyEmail($request->email);
            $numberResponse = $this->verifyMobile($request->mobile_number);

            if ($emailResponse == false && $numberResponse == false) {
                $response = $this->registerUser($request);

                return "Registration Complete";

            } else if ($emailResponse == false && $numberResponse == true) {
                return "Number Registered";
            } else if ($emailResponse == true && $numberResponse == false) {
                return "Email Registered";
            } else {
                return "Both Registered";
            }

        }

    }

    public function registerUser($request){
        $accountInfo = new AccountInfo;
        $accountInfo->email = $request->input('email');
        $accountInfo->password = $request->input('password');
        $accountInfo->login_number = $request->input('mobile_number');
        $accountInfo->account_type = $request->input('account_type');

        if ($accountInfo->save()) {
            return new AccountInfoResource($accountInfo);
        }

    }

    public function verifyEmail($email)
    {
        if (AccountInfo::where('email', '=', $email)->get()->isEmpty()) {
            return false;
        } else
            return true;

    }

    public function verifyMobile($mobileNumber)
    {
        if (AccountInfo::where('login_number', '=', $mobileNumber)->get()->isEmpty()) {
            return false;
        } else
            return true;

    }
}
