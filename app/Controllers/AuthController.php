<?php

namespace App\Controllers;

use App\Core\ControllerBase\Controller;
use App\Core\Database\Database;
use App\Models\UtilizadorModel;
use App\Models\ClienteModel;

class AuthController extends Controller
{
    public function registoFormulario(): void
    {
        $this->view('auth/registo');
    }

    public function registar(): void
    {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($nome === '' || $email === '' || $password === '') {
            die('Todos os campos são obrigatórios.');
        }

        $utilizadorModel = new UtilizadorModel();

        if ($utilizadorModel->buscarPorEmail($email) !== false) {
            die('Já existe uma conta registada com este email.');
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $pdo = Database::getConexao();

        try {
            $pdo->beginTransaction();

            $utilizadorId = $utilizadorModel->criar([
                'nome' => $nome,
                'email' => $email,
                'password_hash' => $passwordHash,
                'perfil_id' => 3, // Cliente
            ]);

            $clienteModel = new ClienteModel();
            $clienteModel->criar([
                'utilizador_id' => $utilizadorId,
                'tipo_cliente' => 'individual',
            ]);

            $pdo->commit();
        } catch (\Exception $e) {
            $pdo->rollBack();
            die('Ocorreu um erro ao criar a conta: ' . $e->getMessage());
        }

        echo "Conta criada com sucesso! Utilizador ID: {$utilizadorId}";
    }

    public function loginFormulario(): void
{
    $this->view('auth/login');
}

    public function login(): void
    {
            $email = trim($_POST['email'] ?? '');
             $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            die('Email e password são obrigatórios.');
        }

            $utilizadorModel = new UtilizadorModel();
             $utilizador = $utilizadorModel->buscarPorEmail($email);

        if ($utilizador === false || !password_verify($password, $utilizador['password_hash'])) {
        die('Email ou password incorretos.');
        }

        if ((int) $utilizador['ativo'] !== 1) {
        die('Esta conta está desativada.');
        }

         session_start();
         $_SESSION['utilizador_id'] = $utilizador['id'];
         $_SESSION['utilizador_nome'] = $utilizador['nome'];
         $_SESSION['perfil_id'] = $utilizador['perfil_id'];

        header('Location: /inicio');
        exit;
    }
}