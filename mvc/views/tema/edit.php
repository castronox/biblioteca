<?php
Auth::oneRole(["ROLE_ADMIN","ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar tema <?= APP_NAME ?></title>
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
    <?= (TEMPLATE)::getHeader('Actualizar tema') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>
    <!-- AQUI VA EL MAIN DE LA NUEVA VISTA -->
    <main>

        <h1><?= APP_NAME ?></h1>
        <h2>Edición del tema <?= $tema->tema ?></h2>


    <form action="/Tema/update" method="post">

    <input type="hidden" name="id"  value="<?= $tema->id ?>">


    <label>Tema</label>
    <input type="text" name="tema" value=" <?= old('tema', $tema->tema)?>">
    <br>

    <label>Descripción</label>
    <input type="textarea" name="descripcion" value=" <?= old('descripcion', $tema->descripcion)?>">
    <br>

    <input type="submit" class="button" name="actualizar">
    </form>
    
    </main>
    <!-- FINALIZA ------------------------------------------ -->

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>