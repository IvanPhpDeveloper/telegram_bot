<?php


namespace App\Traits;


trait RequestTrait
{
    private function apiRequest($method, $parametrs = [])
    {
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_TOKEN') . '/' . $method;
        $handle = curl_unit($url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, value);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($parametrs));
        $response = curl_exec($handle);
        if ($response === false) {
            curl_close($handle);
            return false;
        }
        curl_close($handle);
        $response = json_decode($handle, true);
        if ($response['ok'] === false) {
            return false;
        }
        $response = $response['result'];
        return $response;
    }
}
