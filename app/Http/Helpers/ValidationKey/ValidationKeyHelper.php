<?php

namespace App\Http\Helpers\ValidationKey;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

/**
 * Class ValidationKeyHelper
 */
class ValidationKeyHelper   {

    /**
     * This function generates a validation key by encrypting an array including the domain and the creation date/time
     *
     * @param string $domain
     * @param Carbon $createdAt
     * @return string
     */
    public static function generateKey(String $domain, Carbon $createdAt) : string {
        return Crypt::encrypt([
            'domain' => $domain,
            'createdAt' => $createdAt
        ]);
    }

}
