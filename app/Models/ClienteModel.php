<?php

namespace App\Models;

use App\Core\ModelBase\Model;

class ClienteModel extends Model
{
    public function criar(array $dados): int
    {
        $sql = "INSERT INTO clientes (utilizador_id, tipo_cliente, nif, contacto)
                VALUES (:utilizador_id, :tipo_cliente, :nif, :contacto)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':utilizador_id', $dados['utilizador_id'], \PDO::PARAM_INT);
        $stmt->bindValue(':tipo_cliente', $dados['tipo_cliente'] ?? 'individual');
        $stmt->bindValue(':nif', $dados['nif'] ?? null);
        $stmt->bindValue(':contacto', $dados['contacto'] ?? null);
        $stmt->execute();

        return (int) $this->pdo->lastInsertId();
    }
}