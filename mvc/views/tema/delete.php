<?php
Auth::oneRole(["ROLE_ADMIN", "ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar tema <?= APP_NAME ?></title>
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
    <?= (TEMPLATE)::getHeader('Borrar tema') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>
    <!-- AQUI VA EL MAIN DE LA NUEVA VISTA -->
    <main>

        <h1><?= APP_NAME ?></h1>

        <h2>Borrado del tema <?= $tema->tema ?></h2>

        <form action="/Tema/destroy" method="post">

            <p>Confirmna el borrado de <b><?= $tema->tema ?></b> ? </p>

            <input type="hidden" name="id" value="<?= $tema->id ?>">
            <input class="button" type="submit" name="borrar" value="Borrar">


        </form>

    </main>
    <!-- FINALIZA ------------------------------------------ -->

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>