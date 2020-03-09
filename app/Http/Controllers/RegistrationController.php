<?php

namespace App\Http\Controllers;

use App\Traits\ReturnError;
use Illuminate\Http\Request;
use App\AccountInfo;
use App\Expert;
use App\ServiceMap;
use App\Http\Resources\AccountInfo as AccountInfoResource;

class RegistrationController extends Controller
{
    use ReturnError;


    public function store(Request $request)
    {

        if ($request->isMethod('post')) {

            $emailResponse = $this->verifyEmail($request->email);
            $numberResponse = $this->verifyMobile($request->mobile_number);

            if ($emailResponse == false && $numberResponse == false) {
                $response = $this->registerUser($request);

                return "Registration Complete";

            } else if ($emailResponse == false && $numberResponse == true) {

                //return "Number Registered";
                return $this->errorResponse(401, "Mobile number already registered")->response()->setStatusCode(400);


            } else if ($emailResponse == true && $numberResponse == false) {
                //return "Email Registered";
                return $this->errorResponse(401, "Email already registered")->response()->setStatusCode(400);

            } else {
                //return "Both Registered";
                return $this->errorResponse(401, "Email & Mobile number already registered")->response()->setStatusCode(400);
            }

        }

    }

    public function registerUser($request)
    {

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $mobileNumber = $request->input('mobile_number');
        $email = $request->input('email');
        $serviceType = $request->input('service_type');
        $accountType = $request->input('account_type');
        $password = $request->input('password');



        $accountInfo = new AccountInfo;
        $accountInfo->email = $email;
        $accountInfo->login_number = $mobileNumber;
        $accountInfo->account_type = $accountType;
        $accountInfo->password = $password;

        $accountInfo->save();


        $lastid = $accountInfo->id;

        if ($accountType == 2) {
            $expert = new Expert;
            $expert->first_name = $firstName;
            $expert->last_name = $lastName;
            $expert->contact_number = $mobileNumber;
            $expert->account_info_id = $lastid;
            $expert->save();

            $lastExpertId = $expert -> id;

            foreach ($serviceType as $key){
                $map = new ServiceMap;

               $map -> expert_id = $lastExpertId;

               $map -> service_category_id = $key;

                $map->save();

            }
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
