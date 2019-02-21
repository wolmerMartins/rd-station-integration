<?php
    require_once "ConversionRDStation.php";

    function validateKeyValue($key) {
        if (strrpos($key, "empresa") !== false || strrpos($key, "company") !== false || strrpos($key, "fantasia") !== false) {
            return "company_name";
        } elseif (strrpos($key, "nome") !== false || strrpos($key, "name") !== false) {
            return "name";
        } elseif (strrpos($key, "telefone") !== false || strrpos($key, "phone") !== false) {
            if (strlen($_POST[$key]) === 14) {
                return "mobile_phone";
            } else {
                return "personal_phone";
            }
        } elseif (strrpos($key, "email") !== false) {
            return "email";
        } else {
            return $key;
        }
    }

    foreach ($_POST as $key => $value) {
        $keyValue = validateKeyValue($key);
        $client[$keyValue] = $value;
    }

    $convert = new ConversionRDStation($client);
    $convert->convertToRDStation();