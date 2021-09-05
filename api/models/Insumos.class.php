<?php

require_once "Conexao.class.php";

class Insumos {

    private $funcao;
    private $data;

    public function __construct($funcao, $data) {
        $this->funcao = $funcao;
        $this->data = $data;
    }

    /*======================================================================================*/

    private function cadastarInsumos() {
        return $this->data;
        return ['insumos'];
    }

    /*======================================================================================*/

    private function listarInsumos() {
        return [
            ["id" => 1, "nome" => "dipirona"],
            ["id" => 2, "nome" => "para-c-ta-mal"],
            ["id" => 3, "nome" => "eno"],
        ];
    }

    /*======================================================================================*/

    private function editarInsumos() {
        return ['insumos'];
    }

    /*======================================================================================*/

    private function deletarInsumos() {
        return ['insumos'];
    }

    /*======================================================================================*/

    public function executarFuncao() {
        $funcao = $this->funcao;
        
        return $this->$funcao();
    }

}