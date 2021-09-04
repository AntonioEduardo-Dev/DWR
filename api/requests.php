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
    $dados_funcao = $metodos_disponiveis[$funcionalidade];

    if (in_array($_SESSION['DWR_typeUser'], $dados_funcao['users'])) {

        if ($dados_funcao['class'] == 'Insumos') {
            require "models/Insumos.class.php";

            $model = new Insumos($funcionalidade);
        }

        responseJson("success", "Sucesso", $model->executarFuncao());
    } else {
        responseJson("error", "Funcionalidade Não Permitida");
    }
} else {
    responseJson("error", "Funcionalidade Indisponível");
}