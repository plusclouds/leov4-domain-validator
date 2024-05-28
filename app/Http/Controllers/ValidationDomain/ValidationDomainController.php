<?php

namespace App\Http\Controllers\ValidationDomain;

use App\Http\Controllers\Controller as Controller;
use App\Http\Helpers\ValidationDomain\ValidationDomainHelper;
use App\Http\Requests\ValidationDomain\ValidationDomainRequest;
use Exception;

class ValidationDomainController extends Controller
{
    public function checkValidation(ValidationDomainRequest $request)
    {
        $isDomainValid = false;
        if ($request["method"] == "dns") {
            $isDomainValid = ValidationDomainHelper::checkDns($request["domain"]);
        } else {
            $isDomainValid = ValidationDomainHelper::checkHttp($request["domain"]);
        }

        return response()->json([
            "is_valid" => $isDomainValid
        ]);
    }
}
