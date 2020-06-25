<?php

class Database {
    // Cria a conexão com o BD
    public static function getConnection() {
        // Caminho real do arquivo de configuração da conexão
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);
        $conn = new mysqli($env['host'], $env['username'], $env['password'], $env['database']);
        // Se tive erro mostra qual erro
        if($conn->connect_error) {
            die("Erro: " . $conn->connect_error);
        }
        //retorna a conexão
        return $conn;
    }
    // Consulta no BD passando uma query 
    public static function getResultFromQuery($sql) {
        $conn = self::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }   

    // Outras manipulações no BD sem ser consulta
    public static function executeSQL($sql) {
        $conn = self::getConnection();
        if(!mysqli_query($conn, $sql)) {
            throw new Exception(mysqli_error($conn));
        }
        $id = $conn->insert_id;
        $conn->close();
        return $id;
    } 
}