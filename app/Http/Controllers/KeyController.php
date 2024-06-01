<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Http\Services\KeyService;
use App\Http\Requests\KeyRequest;

class KeyController extends Controller
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
    public function create(KeyRequest $request)
    {
        return response()->json([
            [
                'key' => KeyService::generateKey($request->validated()['domain'])
            ]
        ]);
    }
}
