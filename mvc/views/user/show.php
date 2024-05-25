<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title> Datos de usuario </title>

    <!-- META -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Mostrar usuario.'>
    <meta name='author' content='Cristian Castro'>


    <!-- FAVICON -->
    <link rel='shortcut icon' href='/favicon.ico' type='image/png'>


    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Lista') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>
    <?= (TEMPLATE)::getBreadCrumbs([

'Lista de usuarios' => '/User/list',
'Mostrar usuario' => NULL,
]) ?>
    <main>
        <h1><?= APP_NAME ?></h1>

        <div class="flex-container">
            <section class="flex1 centrado">
                <h2><?= $user->displayname ?></h2>

                <p><b>Nombre (Displayname)</b>: <?= $user->displayname ?></p>
                <p><b>Email :</b><?= $user->email ?></p>
                <p><b>Teléfono de contacto: </b><?= $user->phone ?></p>
                <p><b>Roles de usuario: </b><?= arrayToString($user->roles) ?></p>

            </section>
            <section class="flex1 centrado">

                <figure class="flex1 centrado">
                    <img src="<?= USER_IMAGE_FOLDER. '/' . ($user->foto ?? DEFAULT_USER_IMAGE) ?>" class="cover"  
                        alt="Portada de <?= $user->displayname ?>">
                        <figcaption>Usuario: <?= $user->displayname ?></figcaption>

                </figure>
            </section>
        </div>
        <br><br><br>
        <div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a>
			<a class="button" href="/user/list">Lista de usuarios</a>
			<a class="button" href="/user/edit/<?= $user->id ?>">Editar usuario</a>
			<a class="button" href="/user/delete/<?= $user->id ?>">Borrar usuario</a>

		</div>



    </main>

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>