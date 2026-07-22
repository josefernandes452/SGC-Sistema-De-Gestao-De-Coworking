<?php 

    $localConfig = __DIR__ . '/database.local.php';

    if (!file_exists($localConfig)){
        die('Ficheiro config/database.local.php não encontrado. Copia database.example.php e preenche as tuas credenciais.');
    }

    return require $localConfig;
    