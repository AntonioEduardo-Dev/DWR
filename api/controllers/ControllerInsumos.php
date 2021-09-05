<?php

require "models/Insumos.class.php";

class ControllerInsumos {

    private $funcao;
    private $Insumos;

    private $type = "error";
    private $message = "Não foi possível concluir a funcionalidade";
    private $dataResponse = [];

    public function __construct($funcao, $data) {
        $this->funcao = $funcao;
        $this->Insumos = new Insumos($data);
    }

    /*======================================================================================*/

    private function cadastarInsumo() {
        if ($this->Insumos->cadastarInsumo()) {
            $this->type = "success";
            $this->message = "Insumo Inserido";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function listarInsumos() {
        $this->dataResponse = $this->Insumos->listarInsumos();

        if (empty($this->dataResponse)) {
            $this->type = "warning";
            $this->message = "Nenhum Insumo Encontrado";
        } else {
            $this->type = "success";
            $this->message = "Insumos Encontrados";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function editarInsumo() {
        if ($this->Insumos->editarInsumo()) {
            $this->type = "success";
            $this->message = "Insumo Atualizado";
        }

        $this->retorno();
    }

    /*======================================================================================*/

    private function deletarInsumo() {
        if ($this->Insumos->deletarInsumo()) {
            $this->type = "success";
            $this->message = "Insumo Deletado";
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