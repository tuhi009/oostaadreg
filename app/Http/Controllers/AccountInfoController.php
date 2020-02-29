<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountInfo;
use App\Http\Resources\AccountInfo as AccountInfoResource;

class AccountInfoController extends Controller
{
    public function index()
    {
        $accountinfos = AccountInfo::all();
        return AccountInfoResource::collection($accountinfos);
    }

    public function show($id)
    {
        $accountinfo = AccountInfo::findOrFail($id);

        return new AccountInfoResource($accountinfo);
    }


    public function store(Request $request)
    {
        $accountInfo = $request->isMethod('put') ? AccountInfo::findOrFail
        ($request->accountInfo_id) : new AccountInfo;

        $accountInfo->id = $request->input('accountInfo_id');
        $accountInfo->email = $request->input('email');
        $accountInfo->password = $request->input('password');
        $accountInfo->login_number = $request->input('mobile_number');
        $accountInfo->account_type = $request->input('account_type');

        if ($accountInfo->save()) {
            return new AccountInfoResource($accountInfo);
        }

    }

    public function destroy($id)
    {
        $accountInfo = AccountInfo::findOrFail($id);
        if ($accountInfo->delete()) {
            return new AccountInfoResource($accountInfo);

        }

    }
}
