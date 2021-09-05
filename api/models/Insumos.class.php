<?php

require_once "Conexao.class.php";

class Insumos {

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    /*======================================================================================*/

    public function cadastarInsumo() {
        $conexao = new Conexao();
        $connection = $conexao->conectar();
        
        try {
            $sql = "INSERT INTO insumos
                    VALUES (null, :nome, :categoria, :disponibilidade, :descricao, :img)
            ";

            $consulta = $connection->prepare($sql);

            $consulta->bindValue(":nome", $this->data['nome']);
            $consulta->bindValue(":categoria", $this->data['categoria']);
            $consulta->bindValue(":disponibilidade", ($this->data['disponibilidade'] == 'sim') ? 1 : 0);
            $consulta->bindValue(":descricao", $this->data['descricao']);
            $consulta->bindValue(":img", $this->data['img']);
            
            $consulta->execute();

            return ($consulta->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*======================================================================================*/

    public function listarInsumos() {
        $conexao = new Conexao();

        return $conexao->getAll("insumos", $this->data['id']);
    }

    /*======================================================================================*/

    public function editarInsumo() {
        $conexao = new Conexao();
        $connection = $conexao->conectar();

        try {
            $sql = "UPDATE insumos 
                    SET nome = :nome, categoria = :categoria, disponibilidade = :disponibilidade, 
                        descricao = :descricao, img = :img
                    WHERE id = :id
            ";

            $consulta = $connection->prepare($sql);

            $consulta->bindParam(":id", $this->data['id']);
            $consulta->bindValue(":nome", $this->data['nome']);
            $consulta->bindValue(":categoria", $this->data['categoria']);
            $consulta->bindValue(":disponibilidade", ($this->data['disponibilidade'] == 'sim') ? 1 : 0);
            $consulta->bindValue(":descricao", $this->data['descricao']);
            $consulta->bindValue(":img", $this->data['img']);

            $consulta->execute();

            return ($consulta->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*======================================================================================*/

    public function deletarInsumo() {
        $conexao = new Conexao();
        
        return ($conexao->delete($this->data['id'], "insumos")) ? true : false;
    }
}