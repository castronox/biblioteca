<?php 
Auth::admin();
?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title> Editar Usuario <?= $user->displayname ?> </title>

    <!-- META -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Edición de usuario de <?= APP_NAME ?>'>
    <meta name='author' content='Cristian Castro'>


    <!-- FAVICON -->
    <link rel='shortcut icon' href='/favicon.ico' type='image/png'>


    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader("Editar usuario $user->displayname") ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <!-- MIGAS -->
    <?= (TEMPLATE)::getBreadCrumbs([

        'Lista de usuarios' => '/User/list',
        'Editar usuario' => NULL,
    ]) ?>


    <main>
        <h1 class="centrado">Edicion del usuario <?= $user->displayname ?></h1>

        <div class="flex-container">
            <section class="flex1 centrado">
                <form method="post" class="centrado" enctype="multipart/form-data" action="/User/update">
                    <!-- input oculto para obtener el ID  de usuario a actualizar en cuestion -->

                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <!-- Campos del formulario para editar-->


                    <label for="displayname">DisplayName:</label>
                    <input type="text" name="displayname" value="<?= old('displayname', $user->displayname) ?>">
                    <br>
                    <label for="email">Email: </label>
                    <input type="email" name="email" value="<?= old('email', $user->email) ?>">
                    <br>
                    <label for="phone">Teléfono: </label>
                    <input type="number" name="phone" value="<?= old('phone', $user->phone) ?>">
                    <br>
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" value="<?= old('password', $user->password) ?>">
                    <br>
                    <label>Picture</label>
                    <input type="file" name="picture" accept="image/*" id="file-with-preview"
                        value="<?= old('perfil', $socio->perfil) ?>">
                    <br>
                    <label for="roles">Seleccione roles:</label><br>
                    



                    <input class="button" type="submit" name="actualizar" value="Actualizar">
                </form>
            </section>


            <section class="flex1 centrado">
                <script src="/js/Preview.js"></script>
                <figure class="flex1 centrado">

                    <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?>"
                        id="preview-image" class="cover" alt="Previsualización del perfil de <?= $user->displayname ?>">
                    <figcaption>Previsualización de la portada de <?= $user->displayname ?></figcaption>

                    <form method="POST" action="/user/dropPhoto">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <input type="submit" class="button" name="borrar" value="Eliminar portada">
                    </form>
                </figure>
            </section>

        </div>

        </div>


        <br><br><br><br>
        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/user/list">Lista de usuarios</a>
        </div>



    </main>

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>