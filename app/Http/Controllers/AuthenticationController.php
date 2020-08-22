<?php

namespace App\Http\Controllers;

use Str;
use Hash;
use App\User;
use App\Token;
use Validator;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        $response = (object)array();
        $response -> success = false;

        if ($validator -> fails()) {
            $response -> errors = $validator -> messages();
            return response()->json($response);
        }

        $user = User::where('email', '=', $request->email)->first();

        if ($user == null) {
            $response -> errors = (object)array();
            $response -> errors -> badData = ['Invalid login data']; 
            return response()->json($response);
        }

        if (!(Hash::check($request->password, $user->password))) {
            $response -> errors = (object)array();
            $response -> errors -> badData = ['Invalid login data']; 
            return response()->json($response);
        }

        if ($user->token != null) {
            $user->token->delete();
        }

        $token = new Token;
        $token->token = Str::random(32);
        $token->user_id = $user->id;
        $token->save();

        $response -> success = true;
        $response -> token = $token->token;

        return response()->json($response);
    }

    function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        $response = (object)array();
        $response -> success = false;

        if ($validator -> fails()) {
            $response -> errors = $validator -> messages();
            return response()->json($response);
        }

        if (User::where('email', '=', $request->email)->first() != null) {
            $response -> errors = (object)array();
            $response -> errors -> email = ['This email is already used']; 
            return response()->json($response);
        }

        $user = new User;
        $user -> email = $request -> email;
        $user -> name = $request -> name;
        $user -> password = Hash::make($request -> password);
        $user -> save();

        $token = new Token;
        $token->token = Str::random(32);
        $token->user_id = $user->id;
        $token->save();
        
        $response -> success = true;
        $response -> token = $token->token;

        return response()->json($response);
    }

    function logout (Request $request) {
        
    }
}
