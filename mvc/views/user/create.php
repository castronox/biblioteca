<?php
Auth::admin();
?>
<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title> Crear nuevo usuario </title>

    <!-- META -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Crear nuevo usuario'>
    <meta name='author' content='Cristian Castro'>


    <!-- FAVICON -->
    <link rel='shortcut icon' href='/favicon.ico' type='image/png'>


    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Crear nuevo usuario') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>
    <!-- MIGAS -->
    <?= (TEMPLATE)::getBreadCrumbs([
    
    'Inicio' => '/',
    'Crear usuario' => NULL,
    ]) ?>

    <main>
        <section>
            <h1>Nuevo usuario:</h1>

            <div class="flex-container">
                <form method="post" action="/User/store" enctype="multipart/form-data" class="flex2"
                    action="/User/store">

                    <label for="nombre">Nombre:</label>
                    <input type="text" name="displayname">
                    <br>

                    <label for="Email">Email:</label>
                    <input type="email" name="email">
                    <br>

                    <label for="phone">Teléfono:</label>
                    <input type="text" name="phone">
                    <br>

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password">
                    <br>

                    <label for="repetetir_pwsd">Repetir:</label>
                    <input type="password" name="repeatpassword">
                    <br>

                    <label for="imagen_perfil">Imagen de perfil:</label>
                    <input type="file" name="picture" accept="image/*" id="file-with-preview">
                    <br>


                    <label for="rol">ROL:</label>
                    <select name="roles">

                        <?php foreach (USER_ROLES as $roleName => $roleValue) { ?>
                            <option value="<?= $roleValue ?>"><?= $roleName ?></option>

                        <?php } ?>


                    </select>

                    <br><br>

                    <input type="submit" class="button " name="guardar" value="Guardar">

                </form>

                <figure class="flex1 centrado">
                    <script src="/js/Preview.js"></script>
                    <img src="<?= USER_IMAGE_FOLDER . '/' . DEFAULT_USER_IMAGE ?>" id="preview-image" class="cover"
                        alt="Previsualización de la imagen de perfil">
                    <figcaption>Previsualización de la imagen de perfil</figcaption>
                </figure>

            </div>
        </section>

        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a>
        </div>
    </main>

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>