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
    }
?>