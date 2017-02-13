<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends \App\Http\Controllers\Auth\AuthController
{
    public function index(){
        return view('welcome');
    }
}
