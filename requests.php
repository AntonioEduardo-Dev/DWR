<?php

$routes = [
    "GET" => [
        'listarInsumos' => [ "user", "admin" ],
    ],
    "POST" => [
        'cadastarInsumos' => [ "admin" ],
    ],
    "PUT" => [
        'editarInsumos' => [ "admin" ],
    ],
    "DELETE" => [
        'deletarInsumos' => [ "admin" ],
    ],
];

$metodo = $_SERVER['REQUEST_METHOD'];
$funcionalidade = dadosIsset('funcionalidade', $metodo);

if (empty($funcionalidade)) responseJson("error", "Informe a funcionalidade que deseja");

$metodos_disponiveis = $routes[$metodo];

if (key_exists($funcionalidade, $metodos_disponiveis)) {
    $permissoes = $metodos_disponiveis[$funcionalidade];

    if (in_array($_SESSION['DWR_typeUser'], $permissoes)) {
        responseJson("success", "Ok");
    } else {
        responseJson("error", "Funcionalidade Não Permitida");
    }
} else {
    responseJson("error", "Funcionalidade Indisponível");
}