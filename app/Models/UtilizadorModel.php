<?php

namespace App\Models;

use App\Core\ModelBase\Model;

class UtilizadorModel extends Model
{
    public function buscarPorEmail(string $email): array|false
    {
        $sql = "SELECT * FROM utilizadores WHERE email = :email LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function criar(array $dados): int
    {
        $sql = "INSERT INTO utilizadores (nome, email, password_hash, perfil_id, ativo)
                VALUES (:nome, :email, :password_hash, :perfil_id, :ativo)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $dados['nome']);
        $stmt->bindValue(':email', $dados['email']);
        $stmt->bindValue(':password_hash', $dados['password_hash']);
        $stmt->bindValue(':perfil_id', $dados['perfil_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':ativo', $dados['ativo'] ?? 1, \PDO::PARAM_INT);
        $stmt->execute();

        return (int) $this->pdo->lastInsertId();
    }
}