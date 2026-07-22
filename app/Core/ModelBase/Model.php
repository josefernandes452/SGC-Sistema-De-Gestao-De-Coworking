<?php

namespace App\Core\ModelBase;

use App\Core\Database\Database;
use PDO;

abstract class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConexao();
    }
}