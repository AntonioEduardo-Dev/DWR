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
                    VALUES (null, :id_user, '".Date("Y-m-d H:i:s")."', :insumos, 'pendente')
            ";

            $consulta = $connection->prepare($sql);

            $consulta->bindValue(":id_user", $this->data['id_user']);
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

    public function listarPedidosUser() {
        $conexao = new Conexao();
        $connection = $conexao->conectar();

        try {
            $sql = "SELECT * FROM pedidos
                    WHERE id_user_fk = :id_user
            ";

            if (!empty($this->data['id'])) $sql .= " AND id = :id";

            $consulta = $connection->prepare($sql);

            $consulta->bindValue(":id_user", $this->data['id_user']);
            (!empty($this->data['id'])) && $consulta->bindValue(":id", $this->data['id']);
    
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                return (!empty($this->data['id'])) ? $consulta->fetch($connection::FETCH_ASSOC) : $consulta->fetchAll($connection::FETCH_ASSOC);
            } else return [];
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    /*======================================================================================*/

    public function listarPedidos() {
        $conexao = new Conexao();
        $connection = $conexao->conectar();

        try {
            $sql = "SELECT pedidos.*, nome FROM pedidos
                    INNER JOIN users ON users.id = id_user_fk
            ";

            if (!empty($this->data['id'])) $sql .= " WHERE id = :id";

            $consulta = $connection->prepare($sql);

            (!empty($this->data['id'])) && $consulta->bindValue(":id", $this->data['id']);
    
            $consulta->execute();

            if ($consulta->rowCount() > 0) {
                return (!empty($this->data['id'])) ? $consulta->fetch($connection::FETCH_ASSOC) : $consulta->fetchAll($connection::FETCH_ASSOC);
            } else return [];
        } catch (PDOException $e) {
            echo "Erro de autenticação: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
        
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