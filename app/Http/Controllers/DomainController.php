<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Services\DomainService;
use App\Http\Requests\DomainRequest;

class DomainController extends Controller
{
    /**
     * This method is used to check if the domain is valid or not.
     *
     * @param DomainRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkValidation(DomainRequest $request)
    {
        return response()->json([
            "is_valid" => DomainService::validateDomain($request['domain'])
        ]);
    }
}
