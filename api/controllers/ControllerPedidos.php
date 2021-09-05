<?php

require "models/Pedidos.class.php";

class ControllerPedidos {

    private $funcao;
    private $Pedidos;

    private $type = "error";
    private $message = "Não foi possível concluir a funcionalidade";
    private $dataResponse = [];

    public function __construct($funcao, $data) {
        $this->funcao = $funcao;

        // if ($funcao == "cadastrarPedido" && is_array($data['insumos'] = json_decode($data['insumos']))) {
        if ($funcao == "cadastrarPedido" && is_array($data['insumos'])) {
            $insumos = "";

            foreach ($data['insumos'] as $idx => $insumo) {
                if ($idx > 0) $insumos .= ";";

                // $insumos .= "{$insumo->qtd}x {$insumo->nome}";
                $insumo .= "{$insumo['qtd']}x {$insumo['nome']}";
            }

            $data['insumos'] = $insumos;
        }
        $data['id_user'] = $_SESSION["DWR_idUser"];

        $this->Pedidos = new Pedidos($data);
    }

    /*======================================================================================*/

    private function cadastrarPedido() {
        if ($this->Pedidos->cadastrarPedido()) {
            $this->type = "success";
            $this->message = "Pedido Inserido";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function listarPedidos() {
        $this->dataResponse = $this->Pedidos->listarPedidos();

        if (empty($this->dataResponse)) {
            $this->type = "warning";
            $this->message = "Nenhum Pedido Encontrado";
        } else {
            $this->type = "success";
            $this->message = "Pedidos Encontrados";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function listarPedidosUser() {
        $this->dataResponse = $this->Pedidos->listarPedidosUser();

        if (empty($this->dataResponse)) {
            $this->type = "warning";
            $this->message = "Nenhum Pedido Encontrado";
        } else {
            $this->type = "success";
            $this->message = "Pedidos Encontrados";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function editarStatusPedido() {
        if ($this->Pedidos->editarStatusPedido()) {
            $this->type = "success";
            $this->message = "Status do Pedido Atualizado";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    public function executarFuncao() {
        $funcao = $this->funcao;
        
        return $this->$funcao();
    }

    /*======================================================================================*/

    public function retorno() {
        responseJson($this->type, $this->message, $this->dataResponse);
    }

}