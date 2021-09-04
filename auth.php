<?php

function base64UrlEncode($data)
{
    // First of all you should encode $data to Base64 string
    $b64 = base64_encode($data);

    // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
    if ($b64 === false) {
        return false;
    }

    // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
    $url = strtr($b64, '+/', '-_');

    // Remove padding character from the end of line and return the Base64URL result
    return rtrim($url, '=');
}

function tokenValidate($auth) {
    $bearer = explode(' ', $auth);
    $token = explode('.', $bearer[1]);
    $header = $token[0];
    $payload = $token[1];
    $sign = $token[2];

    $data_payload = json_decode(base64_decode($payload));

    $tempo_token = 60 * 60 * 24;

    if ($data_payload->sub + $tempo_token < time())
        return false;

    $user_sing = ($data_payload->dados->typeUser == "admin") ? "adminKey" : "userKey";

    //Conferir Assinatura
    $valid = hash_hmac('sha256', $header . "." . $payload, $user_sing, true);
    $valid = base64UrlEncode($valid);

    if ($sign === $valid) {
        $_SESSION["DWR_typeUser"] = $data_payload->dados->typeUser;

        return true;
    } else {
        return false;
    }
}

function login($user, $email, $senha) {
    require "models/Auth.class.php";

    $auth = new Auth();

    if ($auth->login($user . 's', $email, $senha)) {
        //Header Token
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $dados['user'] = $user;

        //Payload - Content
        $payload = [
            'iss' => 'ponto-delivery',
            'sub' => time(),
            'dados' => $dados
        ];

        //JSON
        $header = json_encode($header);
        $payload = json_encode($payload);

        //Base 64
        $header = base64UrlEncode($header);
        $payload = base64UrlEncode($payload);

        
        $user_sing = ($user == "admin") ? "adminKey" : "userKey";

        //Sign
        $sign = hash_hmac('sha256', $header . "." . $payload, $user_sing, true);
        $sign = base64UrlEncode($sign);

        //Token
        $token = $header . '.' . $payload . '.' . $sign;

        responseJson("success", 'Login Realizado', ['JWT_token' => $token]);
    } else {
        responseJson("error", 'Dados Inválidos');
    }
}