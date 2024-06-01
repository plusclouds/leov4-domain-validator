<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Http\Services\DomainService;
use App\Http\Requests\DomainRequest;

class DomainController extends Controller
{

    /**
     * This function sends given domain to related services and returns if the domain is valid or not
     *
     * @param  DomainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkValidation(DomainRequest $request)
    {
        $isDomainValid = DomainService::checkHttp($request->validated()["domain"]);
        if (!$isDomainValid) {
            $isDomainValid = DomainService::checkDns($request->validated()["domain"]);
        }

        return response()->json([
            "is_valid" => $isDomainValid
        ]);
    }
}
