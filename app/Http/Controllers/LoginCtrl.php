<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class LoginCtrl extends Controller
{
    public function login(Request $request)
    {
        $auth = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($auth)) {
            $res = 'ok';
        } else {
            $res = 'failed';
        }

        return response()->json(['response'=>$res]);
    }


    /**
     *
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect()->to('/');
    }
}
