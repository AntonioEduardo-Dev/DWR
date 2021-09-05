<?php

$routes = [
    "GET" => [
        'listarInsumos' => [
            "users" => ["user", "admin"],
            "campos_obrigatorios" => [],
            "campos_opcionais" => ["id"],
            "class" => "Insumos"
        ],
        'listarPedidos' => [
            "users" => ["admin"],
            "campos_obrigatorios" => [],
            "campos_opcionais" => ["id"],
            "class" => "Pedidos"
        ],
        'listarPedidosUser' => [
            "users" => ["user"],
            "campos_obrigatorios" => [],
            "campos_opcionais" => ["id"],
            "class" => "Pedidos"
        ],
    ],
    "POST" => [
        'cadastarInsumo' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["nome", "categoria", "disponibilidade"],
            "campos_opcionais" => ["descricao", "img"],
            "class" => "Insumos"
        ],
        'cadastrarPedido' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["insumos"],
            "campos_opcionais" => [],
            "class" => "Pedidos"
        ],
    ],
    "PUT" => [
        'editarInsumo' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["id", "nome", "categoria", "disponibilidade"],
            "campos_opcionais" => ["descricao", "img"],
            "class" => "Insumos"
        ],
        'editarStatusPedido' => [
            "users" => ["admin"],
            "campos_obrigatorios" => ["id", "status"],
            "campos_opcionais" => [],
            "class" => "Pedidos"
        ],
    ],
    "DELETE" => [
        'deletarInsumo' => [
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
            require "controllers/ControllerInsumos.php";

            $controller = new ControllerInsumos($funcionalidade, $data);
        }

        if ($dados_funcao['class'] == 'Pedidos') {
            require "controllers/ControllerPedidos.php";

            $controller = new ControllerPedidos($funcionalidade, $data);
        }

        $controller->executarFuncao();
    } else {
        responseJson("error", "Funcionalidade Não Permitida");
    }
} else {
    responseJson("error", "Funcionalidade Indisponível");
}