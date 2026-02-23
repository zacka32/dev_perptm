<?php

function CallAPI($method, $url2, $token, $data = false)
{
    $curl = curl_init();

    $secretKey = "1234";
    $request_headers = array('X-API-KEY: '.$secretKey,
                             'Authorization: '.$token);
    
    $url1 = '../../api/v1/';
    $url  = $url1.$url2;

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

?>