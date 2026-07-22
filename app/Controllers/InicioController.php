<?php 

namespace App\Controllers;

use App\Core\ControllerBase\Controller;

class InicioController extends Controller
{
    public function index():void
    {
        $this -> view('inicio/index', [
            'titulo' => 'Sistema de Gestão de Coworking',
        ]);
        
    }
}