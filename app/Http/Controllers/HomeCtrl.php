<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeCtrl extends Controller
{
    public function index()
    {
        return view('home');
    }


    public function addProduct()
    {
        return view('add-product');
    }
}
