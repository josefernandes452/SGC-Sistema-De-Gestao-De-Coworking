<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instancia = null;

    private function __construct()
    {
    }

    public static function getConexao(): PDO
    {
        if(self::$instancia == null) {
            $config =require __DIR__ . '/../../../config/database.php';

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

            try {
                self::$instancia = new PDO($dsn, $config['user'], $config['password'],[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
        
            } catch(PDOException $e){
                die('Erro de ligação à base de dados: ' . $e->getMessage());
            }
        }
            return self::$instancia;
    }
}