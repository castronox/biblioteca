<?php
Auth::admin();
?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title> Eliminar usuario</title>

    <!-- META -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Eliminar usuario de <?= APP_NAME ?>'>
    <meta name='author' content='Cristian Castro'>


    <!-- FAVICON -->
    <link rel='shortcut icon' href='/favicon.ico' type='image/png'>


    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Eliminar usuario') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>


    <!-- MIGAS -->

    <?php
    // Detectar el origen de la navegación desde la URL o cualquier otra fuente
    $from = $_GET['from'] ?? 'show'; // Por defecto es 'show' si no se especifica
    
    // Definir las migas de pan
    $migas = [
        'Inicio' => '/',
        'Lista de usuarios' => '/User/list',
    ];

    if ($from === 'list') {
        $migas["Borrar usuario $user->id"] = NULL;
    } else {
        // Asumimos que el origen es 'show' o cualquier otro valor
        $migas["Mostrar usuario $user->id"] = "/User/show/$user->id";
        $migas["Borrar usuario $user->id"] = NULL;
    }
    ?>
    <?= (TEMPLATE)::getBreadCrumbs($migas) ?>

    <!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
    <main>
        <h1><?= APP_NAME ?></h1>

        <h2>Borrar al usuario <?= $user->displayname ?> ?</h2>


        <form method="POST" action="/User/destroy">
            <p>Confirma borrado del usuario <b><?= $user->displayname ?></b>.</p>

            <input type="hidden" name="id" value="<?= $user->id ?>">
            <input class="button" type="submit" name="borrar" value="Borrar">

        </form>

        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a> <a class="button" href="/user/list">Lista de
                usuarios</a> <a class="button" href="/user/show/<?= $user->id ?>">Detalles</a> <a class="button"
                href="/user/edit/<?= $user->id ?>">Borrado</a>
        </div>

    </main>

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>