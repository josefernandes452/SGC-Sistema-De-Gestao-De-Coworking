<?php

namespace App\Core\ControllerBase;

abstract class Controller
{
    protected function view(string $caminhoView, array $dados = []): void
    {
        extract($dados);

        $caminhoCompleto = __DIR__ . '/../../Views/' . $caminhoView . '.php';

        if (!file_exists($caminhoCompleto)) {
            die("View não encontrada: {$caminhoView}");
        }
        ob_start();
        require $caminhoCompleto;
        $conteudo = ob_get_clean();

        require __DIR__ . '/../../Views/layout.php';
    }
}