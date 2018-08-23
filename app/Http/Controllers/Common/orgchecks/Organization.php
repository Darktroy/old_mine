<?php
/**
 * Created by PhpStorm.
 * User: Gehad
 * Date: 5/16/2018
 * Time: 6:24 PM
 */

namespace App\Http\Controllers\Common\orgchecks;


class Organization
{
    public static function checkOnline($domain)
    {
        $curlInit = curl_init($domain);
        curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curlInit, CURLOPT_HEADER, true);
        curl_setopt($curlInit, CURLOPT_NOBODY, true);
        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);

        //get answer
        $response = curl_exec($curlInit);

        curl_close($curlInit);
        if ($response) return true;
        return false;
    }
}