<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\App_AccRequest;
use App\Http\Requests\Emp_AccRequest;
use App\Models\Applicant_Acc;
use App\Models\Employer_Acc;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Auth1Controller extends Controller
{
    public function login(App_AccRequest $request)
    {

        $app_acc = Applicant_Acc::where('username', $request->username)->first();
     
        if (! $app_acc || ! Hash::check($request->password, $app_acc->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [
            'username'  => $app_acc,
            'token'     => $app_acc->createToken($request->username)->plainTextToken
        ];
     
        return response($response, 200);

    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message'   => 'Logout.'
        ];


        return $response;
    }

    public function login2(Emp_AccRequest $request)
    {

        $emp_acc = Employer_Acc::where('username', $request->username)->first();
     
        if (! $emp_acc || ! Hash::check($request->password, $emp_acc->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [
            'username'      => $emp_acc,
            'token'     => $emp_acc->createToken($request->username)->plainTextToken
        ];
     
        return response($response, 200);

    }



}
