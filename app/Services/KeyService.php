<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

/**
 * Class KeyService
 */
class KeyService
{
    /**
     * This function generates a validation key by encrypting an array including the domain and the creation date/time
     *
     * @param String $domain
     * @return string
     */
    public static function generateKey(String $domain): string
    {
        return Crypt::encrypt([
            'domain' => $domain,
            'createdAt' => Carbon::now()
        ]);
    }
}
