<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;

class DomainService
{

    /**
     * This function compares given token with date of the today and check if difference is bigger than default expiration limit
     *
     * @param array $token
     * @return bool
     */
    private static function isTokenValid(array $token): bool
    {
        $createdAt = new Carbon($token['createdAt']);
        $timeElapsed = $createdAt->diffInSeconds(Carbon::now());
        $tokenExpirationLimit = env("TOKEN_EXPIRATION", "86400");
        return $timeElapsed < $tokenExpirationLimit;
    }


    /**
     * This function iterates over all the dns records of the domain that type TXT and if it finds token, it sends token to isValidToken function and returns the result
     *
     * @param String $domain
     * @return bool
     */
    public static function checkDns(String $domain): bool
    {
        // dns_get_record function creates problem if it see www. or https://
        $newDomain = str_replace(["https://", "www."], "", $domain);

        $dns_records = dns_get_record($newDomain, DNS_TXT);

        foreach ($dns_records as $record) {
            $txtValue = $record["txt"];
            try {
                $decryptToken = Crypt::decrypt($txtValue);
                return static::isTokenValid($decryptToken);
            } catch (Exception $e) {
            }
        }
        return false;
    }

    /**
     * This function reads the file content inside the domain and if it finds token, it sends token to isValidToken function and returns the result
     *
     * @param String $domain
     * @return bool
     */
    public static function checkHttp(String $domain): bool
    {
        $filePath = env("HTTP_VALIDATION_FILE_PATH", "/.well-known/validation.txt");
        $url = $domain . $filePath;
        try {
            $token = file_get_contents($url);
            $decryptToken = Crypt::decrypt($token);
            return static::isTokenValid($decryptToken);
        } catch (Exception $e) {
        }
        return false;
    }

    /**
     * This function checks if the domain is valid or not by checking dns records and http file
     *
     * @param String $domain
     * @return bool
     */
    public static function validateDomain(String $domain): bool
    {
        return static::checkDns($domain) || static::checkHttp($domain);
    }
}
