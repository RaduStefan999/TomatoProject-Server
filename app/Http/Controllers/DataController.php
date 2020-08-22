<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class DataController extends Controller
{
    function products (Request $request) {
        $response = Product::all();

        return response()->json($response);
    }
}
