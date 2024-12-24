<?php

class database 
{

    public function query($sql, $params = [])
    {
        try {
            //conexão e comunicação com base de dados
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            $result = $stmt->fetchAll(PDO::FETCH_CLASS);
            
            //devolver resultado
            return [
                'status' => 'Success',
                'data' => $result
            ];


        } catch (\PDOException $err) {
            // informa erro
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ]; 
        }
    }


    // Método para executar consultas INSERT, UPDATE, DELETE
    public function execute($sql, $params = [])
    {
        try {
            //conexão e comunicação com base de dados
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            // Retorna o número de linhas afetadas
            return [
                'status' => 'Success',
                'affected_rows' => $stmt->rowCount()
            ];

        } catch (PDOException $err) {
            return [
                'status' => 'error',
                'data' => $err->getMessage()
            ]; 
        }
    }
}