<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'SGC - Sistema de Gestão de Coworking' ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

    <header>
        <nav>
            <strong>SGC</strong> — Sistema de Gestão de Coworking
        </nav>
    </header>

    <main>
        <?= $conteudo?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> SGC - Sistema de Gestão de Coworking</p>
    </footer>

    <script src="/script.js"></script>
</body>
</html>