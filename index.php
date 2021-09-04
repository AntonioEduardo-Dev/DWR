<?php

function responseJson($type, $message, $data = []) {
    echo json_encode([
        "type" => $type,
        "message" => $message."!",
        "data" => $data
    ]);

    exit;
}

require "auth.php";

function dadosIsset($indice, $vl_padrao = "") {
    return isset($_POST[$indice]) && $_POST[$indice] != null ? $_POST[$indice] : $vl_padrao;
}

if (isset($_POST['login']) || isset($_POST['loginAdmin'])) {
    $email = dadosIsset('email');
    $senha = dadosIsset('senha');

    if (empty($email) || empty($senha)) {
        responseJson("warning", "Informe todos os dados");
    }

    if (isset($_POST['login'])){
        $user = "user";
    } else if (isset($_POST['loginAdmin'])) {
        $user = "admin";
    }

    login($user, $email, $senha);
}

$http_header = apache_request_headers();

if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
    $auth = $http_header['Authorization'];

    if (tokenValidate($auth)) {
        responseJson("success", "Iep");
        
    } else {
        responseJson("error", "Token Inválido");
    }
} else {
    responseJson("error", "É necessário um Token");
}