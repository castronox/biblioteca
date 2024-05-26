<?php
Auth::oneRole(["ROLE_ADMIN","ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Añadir titulo <?= APP_NAME ?></title>
<!-- META -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Contenido en <?= APP_NAME ?>">
<meta name="author" content="Cristian Castro">
<!-- FAVICON -->
<link rel="shortcut icon" href="/favicon.ico" type="image/png">
<!-- CSS -->
<?= (TEMPLATE)::getCss()?>
</head>
<body>
<?=(TEMPLATE)::getLogin()?>
<?= (TEMPLATE)::getHeader('Escribe el header')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<!-- MIGAS -->
<?= (TEMPLATE)::getBreadCrumbs([

'Inicio' => '/',
'Crear tema' => NULL,
]) ?>
<!-- AQUI VA EL MAIN DE LA NUEVA VISTA -->
<main class="centrado">

<h1>Nuevo tema libro en <?= APP_NAME?> </h1>

<h2></h2>
<hr>

<form class="centrado" action="/tema/store" method="post">

<label>Tema:</label>
<input type="text" name="tema" value="<?=old('tema')?>">
<br>
<label>Descripción</label>
<input type="textarea" name="descripcion" value="<?=old('descripcion')?>">

<br><br><hr><br><br>
<div class="centrado">
    <input type="submit" class="button" name="guardar" value="Guardar">
</div>

</form>

<div class="centrado">
			<a class="button" name="guardar" onclick="history.back()">Atrás</a> 
</div>

</main>
<!-- FINALIZA ------------------------------------------ -->

<?=(TEMPLATE)::getFooter()?>
</body>
</html>