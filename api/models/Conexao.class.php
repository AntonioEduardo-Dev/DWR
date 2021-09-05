<?php

    class Conexao {

        function conectar(){
            $host= "mysql:host=localhost;dbname=dwr";
            $user= "root";
            $pass= "";

            try {
                $pdo = new PDO($host, $user, $pass);
                return $pdo;
            } catch (PDOException $e) {
                echo "Erro de login: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
        
        /*======================================================================================*/

        function getAll($table, $id = "") {
            $connection = $this->conectar();
    
            try {
                $sql = "SELECT * FROM {$table}";
                (!empty($id)) && $sql .= " WHERE id = :id";

                $consulta = $connection->prepare($sql);

                (!empty($id)) && $consulta->bindParam(":id", $id);
    
                $consulta->execute();
    
                if ($consulta->rowCount() > 0) {
                    return (!empty($id)) ? $consulta->fetch($connection::FETCH_ASSOC) : $consulta->fetchAll($connection::FETCH_ASSOC);
                } else return [];
                
            } catch (PDOException $e) {
                echo "Erro de autenticação: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/
        
        function delete($id, $table) {
            $connection = $this->conectar();
    
            try {
                $sql = "DELETE FROM {$table} WHERE id = :id";
    
                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);
    
                $consulta->execute();
    
                return ($consulta->rowCount() > 0) ? true : false;
            } catch (PDOException $e) {
                echo "Erro de autenticação: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    }
?>