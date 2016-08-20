<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\User;

class RegisterCtrl extends Controller
{
    /**
     *
     */
    public function index()
    {
        return view('register');
    }


    /**
     *
     */
    public function meliToken(Request $request)
    {
        if ($this->existMail($request['email'])) {
            $status = 'exits';
        } else {
            User::create([
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'meliUserId' => $request['meliUserId'],
                'meliToken' => $request['meliToken'],
            ]);

            $status = 'registered';
        }

        return response()->json(['status'=>$status]);
    }


    /**
     *
     */
    public function finish()
    {
        return view('final-register');
    }


    /**
     *
     */
    public function verifyExistMail(Request $request)
    {
        if ($this->existMail($request['email'])) {
            $status = 'exits';
        } else {
            $status = 'free';
        }

        return response()->json(['status'=>$status]);
    }


    /**
     * 
     */
    protected function existMail($email)
    {
        $user = User::where('email', $email)
            ->select('email')
            ->first();
       
        if ($user) {
            return true;
        }

        return false;
    }
}
