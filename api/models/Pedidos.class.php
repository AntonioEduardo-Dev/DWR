<?php

require_once "Conexao.class.php";

class Pedidos {

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    /*======================================================================================*/

    public function cadastrarPedido() {
        $conexao = new Conexao();
        $connection = $conexao->conectar();

        try {
            $sql = "INSERT INTO pedidos
                    VALUES (null, '".Date("Y-m-d H:i:s")."', :insumos, 'pendente')
            ";

            $consulta = $connection->prepare($sql);

            $consulta->bindValue(":insumos", $this->data['insumos']);

            $consulta->execute();

            return ($consulta->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*======================================================================================*/

    public function listarPedidos() {
        $conexao = new Conexao();

        return $conexao->getAll("pedidos", $this->data['id']);
    }

    /*======================================================================================*/

    public function editarStatusPedido() {$conexao = new Conexao();
        $connection = $conexao->conectar();

        try {
            $sql = "UPDATE pedidos 
                    SET status = :status
                    WHERE id = :id
                ";

            $consulta = $connection->prepare($sql);

            $consulta->bindParam(":id", $this->data['id']);
            $consulta->bindValue(":status", $this->data['status']);

            $consulta->execute();

            return ($consulta->rowCount() > 0) ? true : false;
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

}