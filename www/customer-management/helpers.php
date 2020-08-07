<?php
declare(strict_types=1);

if (!function_exists('dateObjectUsToBr')) {

    function dateObjectUsToBr(object $date)
    {
        if (is_null($date) || $date == "") {
            return null;
        }

        return date_format($date, 'd/m/Y H:i:s');
    }
}

if (!function_exists('mask')) {

    function mask($val, $mask)
    {
        $maskared = '';
        $k = 0;

        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }
}

if (!function_exists('onlyNumber')) {

    function onlyNumber($input)
    {
        return preg_replace('/\D/', '', $input);
    }
}

if (!function_exists('emailValidation')) {

    function emailValidation($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }else{
            throw new Exception("Email address '$email' is considered invalid.");
        }
    }
}



