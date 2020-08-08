<?php
declare(strict_types=1);

namespace CustomerManagement\Service;

class ViaCepApiService
{
    public function viaCep($zipcode)
    {
        $zipcode = onlyNumber($zipcode);

        $route = "https://viacep.com.br/ws/{$zipcode}/json/";

        if (!$route){
            throw new \Exception("Zipcode {$zipcode} note found!");
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $route);

        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        json_decode(curl_exec($ch),true);

        $return = curl_exec($ch);

        curl_close($ch);

        return $return;
    }
}
