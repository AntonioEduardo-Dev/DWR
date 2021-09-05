<?php

$routes = [
    "GET" => [
        'listarInsumos' => [
            "users" => ["user", "admin"],
            "campos_obrigatorios" => [],
            "campos_opcionais" => [],
            "class" => "Insumos"
        ],
    ],
    "POST" => [
        'cadastarInsumos' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["name"],
            "campos_opcionais" => ["description"],
            "class" => "Insumos"
        ],
    ],
    "PUT" => [
        'editarInsumos' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["id", "name"],
            "campos_opcionais" => ["description"],
            "class" => "Insumos"
        ],
    ],
    "DELETE" => [
        'deletarInsumos' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["id"],
            "campos_opcionais" => [],
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
        $campos_obrigatorios = $dados_funcao['campos_obrigatorios'];
        $campos_opcionais = $dados_funcao['campos_opcionais'];

        $data = [];

        if (count($campos_obrigatorios) > 0) {
            $campos_invalidos = false;

            foreach ($campos_obrigatorios as $campo) {
                $validacao_campo = dadosIsset($campo, $metodo);

                if (empty($validacao_campo)) {
                    $campos_invalidos = true;
                    break;
                }

                $data[$campo] = $validacao_campo;
            }

            if ($campos_invalidos) responseJson("warning", "Preencha os campos obrigatórios");
        }

        if (count($campos_opcionais) > 0) {
            foreach ($campos_opcionais as $campo) {
                $data[$campo] = dadosIsset($campo, $metodo);
            }
        }

        if ($dados_funcao['class'] == 'Insumos') {
            require "models/Insumos.class.php";

            $model = new Insumos($funcionalidade, $data);
        }

        responseJson("success", "Sucesso", $model->executarFuncao());
    } else {
        responseJson("error", "Funcionalidade Não Permitida");
    }
} else {
    responseJson("error", "Funcionalidade Indisponível");
}