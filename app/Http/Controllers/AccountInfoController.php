<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountInfo;

class AccountInfoController extends Controller
{
    public function show()
    {
        $flights = AccountInfo::all();
        foreach ($flights as $flight) {
            echo $flight->password;
        }
    }
}
