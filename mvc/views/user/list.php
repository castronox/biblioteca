<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <title> Lista de usuarios</title>

    <!-- META -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Lista de libros de <?= APP_NAME ?>'>
    <meta name='author' content='Cristian Castro'>


    <!-- FAVICON -->
    <link rel='shortcut icon' href='/favicon.ico' type='image/png'>


    <!-- CSS -->
    <?= (TEMPLATE)::getCss() ?>
</head>

<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Lista de usuarios') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <!-- Migas de la vista-->
    <?= (TEMPLATE)::getBreadCrumbs([
        'Lista de usuarios' => '/User/list/'
    ]) ?>

    
    <main>


        <h2>Lista de usuarios</h2>

        <?php


        if ($filtro) {

            # El método removeFilter Form necesita conocer el Filtro y la ruta a la que se envia el formulario
        
            echo (TEMPLATE)::removeFilterForm($filtro, '/User/list');
        } else {

            echo (TEMPLATE)::filterForm(

                #Ruta que se enía al formulario
                '/User/list',
                # Lista de campos para buscar en 
                ['Nombre' => 'displayname', 'Rol' => 'roles', 'Email' => 'email', 'Phone' => 'phone'],
                ['Nombre' => 'displayname', 'Rol' => 'roles', 'Email' => 'email', 'Phone' => 'phone'],
                # Valor por defecto de buscar en 
                'Nombre',
                # Valor por defecto en ordenar por
                'Nombre',
            );
        }
        ?>


        <?php if ($users) { ?>

            <div class="derecha">
                <?= $paginator->stats() ?>
            </div>

            <table>

                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Roles</th>
                    <th>Foto</th>
                    <th>Operaciones</th>
                </tr>


                <?php foreach ($users as $user) { ?>
                    <tr class="centrado">



                        <td><?= $user->displayname ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->phone ?></td>
                        <td><?= arrayToString($user->roles) ?></td>
                        <td class="centrado">
                            <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?>" class="cover-mini"
                                alt="Perfil de <?= $user->displayname ?>">
                        </td>

                        <td>
                            <a href="/User/show/<?= $user->id ?>">Ver</a>
                            <a href="/User/edit/<?= $user->id ?>">Editar</a>
                            <a href="/User/delete/<?= $user->id ?>">Borrar</a>
                        </td>
                    </tr>

                <?php } ?>
            </table>
            <?= $paginator->ellipsisLinks() ?>
        <?php } else { ?>
            <p>No hay Usuarios que mostrar</p>
        <?php } ?>

    </main>

    <?= (TEMPLATE)::getFooter() ?>
</body>

</html>