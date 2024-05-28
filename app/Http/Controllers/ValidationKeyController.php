<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\Controller as Controller;
use \Illuminate\Http\Request;
class ValidationKeyController extends Controller
{
    public function create($domain, Request $request){
        return response()->json(['domain' => $domain]);

    }
}
