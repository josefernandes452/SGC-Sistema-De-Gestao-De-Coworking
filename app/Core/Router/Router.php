<?php

namespace App\Core\Router;

class Router
{
    private array $rotas = [];
    public function get(string $caminho, string $controller, string $metodo): void {
        $this->adicionar('GET', $caminho, $controller, $metodo);
    }

    public function post(string $caminho, string $controller, string $metodo): void {
        $this-> adicionar('POST', $caminho, $controller, $metodo);
    }

    public function adicionar (string $verbo, string $caminho, string $controller, string $metodo): void {
        $this -> rotas[$verbo][$caminho] = [
            'controller' => $controller,
            'metodo' => $metodo,
        ];
    }

    public function despachar (string $rotaPedida, string $verboPedido): void
    {
        $rotaPedida = trim($rotaPedida, '/');
        if($rotaPedida === '') {
            $rotaPedida = 'inicio';
        }

        $rotaEncontrada = $this->rotas[$verboPedido][$rotaPedida] ?? null;
        
        if ($rotaEncontrada === null) {
            http_response_code(404);
            echo "Página não encontrada.";
            return;
        }

        $nomeControllerCompleto = $rotaEncontrada['controller'];
        $metodo = $rotaEncontrada['metodo'];

        $controller = new $nomeControllerCompleto();
        $controller->$metodo();
    }

}