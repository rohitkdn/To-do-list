<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function authenticate(Request $request) {
        if (!$request->has('username')or !$request->has('password')){

            return response(['error' => 'Username and Password are required.'], 422);
        }

        $user = User::where('username', $request->input('username'))->first();

        if ($user and \Hash::check($request->input('password'), $user->password)) {
            $user->update(['api_token' => str_random(32)]);

            return ['token' => $user->api_token];
        }

        return response(['error' => 'Invalid username or password.'], 401);
    }
}
