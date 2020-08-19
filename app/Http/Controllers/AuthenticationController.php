<?php

namespace App\Http\Controllers;

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
        }

        //Tomato Code - to be removed soon
        if ($request -> email === "radustefan1302@gmail.com" && $request -> password == "Dsoft12345") {
            $response -> token = 'tomato_super_secret';
            $response -> success = true;
        }

        return response()->json($response);
    }
}
