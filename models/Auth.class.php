<?php

require_once "Conexao.class.php";

class Auth {
    
        /*======================================================================================*/

        public function login($table, $email, $senha) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT id, nome FROM {$table}
                        WHERE email = :email AND senha = :senha
                ";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":email", $email);
                $consulta->bindValue(":senha", $senha);

                $consulta->execute();

                return ($consulta->rowCount() > 0) ? $consulta->fetch($connection::FETCH_ASSOC) : false;
            } catch (PDOException $e) {
                echo "Erro de autenticação: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
}