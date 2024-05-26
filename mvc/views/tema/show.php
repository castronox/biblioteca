<?php
Auth::oneRole(["ROLE_ADMIN","ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del tema <?= APP_NAME ?></title>
    <!-- META -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contenido en <?= APP_NAME ?>">
    <meta name="author" content="Cristian Castro">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">
    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Detalles del tema') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>
    <!-- AQUI VA EL MAIN DE LA NUEVA VISTA -->


    <main>

        <h1><?= APP_NAME ?></h1>

        <h2> Detalles de <?= $tema->tema ?> </h2>

        <p><b>Nombre:</b> <?= $tema->tema ?></p>
        <p><b>Descripción:</b> <?= $tema->descripcion ?> </p>
        <div class="centrado">
        <a class="button" onclick="history.back()">Atrás</a>

        </div>
    </main>
    <!-- FINALIZA -------------------------------------------->

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>