<?php

namespace App\Http\Controllers\ValidationKey;

use App\Http\Controllers\Controller as Controller;
use App\Http\Helpers\ValidationKey\ValidationKeyHelper;
use App\Http\Requests\ValidationKey\ValidationKeyCreateRequest;
use Carbon\Carbon;

class ValidationKeyController extends Controller
{
    /**
     * This function generates a validation key by encrypting an array including the domain and the creation date/time and returns it.
     *
     * HTTP Params:
     * - domain: string (url format)
     *
     * @param ValidationKeyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ValidationKeyCreateRequest $request){
        $domain = $request->input('domain');

        $key = ValidationKeyHelper::generateKey($domain, Carbon::now());

        return response()->json([
            [
            'key' => $key
            ]
        ]);
    }
}
