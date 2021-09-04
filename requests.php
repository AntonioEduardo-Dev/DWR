<?php

function listarInsumos() {
    return [
        ["id" => 1, "nome" => "dipirona"],
        ["id" => 2, "nome" => "para-c-ta-mal"],
        ["id" => 3, "nome" => "eno"],
    ];
}

$routes = [
    "GET" => [
        'listarInsumos' => [
            "users" => ["user", "admin"],
            "class" => "Insumos"
        ],
    ],
    "POST" => [
        'cadastarInsumos' => [
            "users" => ["admin"],
            "class" => "Insumos"
        ],
    ],
    "PUT" => [
        'editarInsumos' => [
            "users" => ["admin"],
            "class" => "Insumos"
        ],
    ],
    "DELETE" => [
        'deletarInsumos' => [
            "users" => ["admin"],
            "class" => "Insumos"
        ],
    ],
];

$metodo = $_SERVER['REQUEST_METHOD'];
$funcionalidade = dadosIsset('funcionalidade', $metodo);

if (empty($funcionalidade)) responseJson("error", "Informe a funcionalidade que deseja");

$metodos_disponiveis = $routes[$metodo];

if (key_exists($funcionalidade, $metodos_disponiveis)) {
    $permissoes = $metodos_disponiveis[$funcionalidade]['users'];

    if (in_array($_SESSION['DWR_typeUser'], $permissoes)) {
        responseJson("success", "Ok", $funcionalidade());
    } else {
        responseJson("error", "Funcionalidade Não Permitida");
    }
} else {
    responseJson("error", "Funcionalidade Indisponível");
}