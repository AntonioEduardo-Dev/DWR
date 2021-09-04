<?php

require_once "Conexao.class.php";

class Insumos {

    private $funcao;

    public function __construct($funcao) {
        $this->funcao = $funcao;
    }

    /*======================================================================================*/

    private function listarInsumos() {
        return ['insumos'];
    }

    /*======================================================================================*/

    public function executarFuncao() {
        $funcao = $this->funcao;
        
        return $this->$funcao();
    }

}