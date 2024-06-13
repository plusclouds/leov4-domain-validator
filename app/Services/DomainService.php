<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;

class DomainService
{

    /**
     * Verifies if the provided token is still valid by comparing its creation time with the current time.
     * The token must belong to the given domain.
     *
     * @param String $domain
     * @param mix $token
     * @return bool
     */
    private static function isTokenValid(String $domain, $token): bool
    {
        if ($token == null) return false;

        try {
            $decryptedToken = Crypt::decrypt($token);
        } catch (Exception $e) {
            return false;
        }

        $createdAt = new Carbon($decryptedToken['createdAt']);
        $timeElapsed = $createdAt->diffInSeconds(Carbon::now());
        $tokenExpirationLimit = config("TOKEN_EXPIRATION", "86400");
        return $domain == $decryptedToken['domain'] && $timeElapsed < $tokenExpirationLimit;
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
            if (static::isTokenValid($domain, $txtValue)) return true;
        }
        return false;
    }

    /**
     * This function reads the file content inside the domain and if it finds token, it sends token to isValidToken function and returns the result
     *
     * @param String $domain
     * @return bool
     */
    public static function checkHttp(String $domain, $token = null): bool
    {
        if ($token == null) {
            $filePath = config("HTTP_VALIDATION_FILE_PATH", "/.well-known/validation.txt");
            $url = $domain . $filePath;
            $token = file_get_contents($url);
        }

        return static::isTokenValid($domain, $token);
    }

    /**
     * Validates the domain by checking the DNS TXT records and the validation file on the server.
     *
     * @param String $domain
     * @param mix $token
     * @return bool
     */
    public static function validateDomain(String $domain): bool
    {
        return static::checkDns($domain) || static::checkHttp($domain);
    }
}
