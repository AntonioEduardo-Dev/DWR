<?php

session_start();

date_default_timezone_set("America/Sao_Paulo");

function responseJson($type, $message, $data = []) {
    echo json_encode([
        "type" => $type,
        "message" => $message."!",
        "data" => $data
    ]);

    unset($_SESSION['DWR_typeUser']);
    exit;
}

require "auth.php";

function dadosIsset($indice, $metodo, $vl_padrao = "") {
    switch ($metodo) {
        case 'GET':
            return isset($_GET[$indice]) && $_GET[$indice] != null ? $_GET[$indice] : $vl_padrao;
            break;

        case 'POST':
            return isset($_POST[$indice]) && $_POST[$indice] != null ? $_POST[$indice] : $vl_padrao;
            break;

        case 'DELETE':
            return isset($_DELETE[$indice]) && $_DELETE[$indice] != null ? $_DELETE[$indice] : $vl_padrao;
            break;
    }
}

if (isset($_POST['login']) || isset($_POST['loginAdmin'])) {
    $email = dadosIsset('email', "POST");
    $senha = dadosIsset('senha', "POST");

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
        require "requests.php";
    } else {
        responseJson("error", "Token Inválido");
    }
} else {
    responseJson("error", "É necessário um Token");
}