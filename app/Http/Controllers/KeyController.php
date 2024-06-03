<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Http\Services\KeyService;
use App\Http\Requests\KeyRequest;

class KeyController extends Controller
{
    /**
     *
     * This method is used to generate a key for the domain.
     *
     * @param KeyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(KeyRequest $request)
    {
        return response()->json([
            'key' => KeyService::generateKey($request->validated()['domain'])
        ]);
    }
}
