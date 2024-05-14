<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear prestamo del socio - <?= $socio->nombre ?></title>

<!-- META -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Lista de libros en <?= APP_NAME ?>">
<meta name="author" content="Cristian Castro">


<!-- FAVICON -->
<link rel="shortcut icon" href="/favicon.ico" type="image/png">


<!-- CSS -->
<?= (TEMPLATE)::getCss()?>
</head>
<body>
<?=(TEMPLATE)::getLogin()?>
<?= (TEMPLATE)::getHeader('Nuevo Prestamo')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>
<h1><?= APP_NAME?></h1>

	<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->


<main>

<h2 class="centrado" >Nuevo prestamo de <b><?= $socio->nombre, " " , $socio->apellidos ?></b></h2>

<form method="POST" action="/Prestamo/store">

<input type="hidden" name="idprestamo" value="<?= $prestamo->id?>">

<div class="centrado">
<label>ID Socio</label>
<input type="text" class="centrado" name="idsocio" readonly value="<?= $socio->id?>">
<br>

<label>ID ejemplar</label>
<input type="number" class="centrado" name="idejemplar" >
<br>

<label>Límite</label>

<?php 
$limite = new DateTime();
$limite = $limite->modify('+7 days')->format('Y-m-d');
?>

<input type="date" name="limite" value="<?= old('limite', $limite)?>">

<br><br><br>

<input	type="submit" class="button" name="guardar" value="Guardar">

</div>

</form>



</main>



	<!-- FINALIZA ------------------------------------------ -->

<?=(TEMPLATE)::getFooter()?>
</body>
</html>
