<?php

namespace App\Models;

use App\Core\ModelBase\Model;

class UtilizadorModel extends Model{

    public function buscarPorEmail(string $email): array|false
    {
        $sql = "SELECT * FROM utilizadores WHERE email = :email LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }
}