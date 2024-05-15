<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Borrar el Socio - <?= $socio->nombre . " " .$socio->apellidos?></title>

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
<?= (TEMPLATE)::getHeader('Borrar Socio')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->


		<h1><?= APP_NAME ?></h1>
		<h2>Borrado del socio <?= $socio->nombre?></h2>

		<form method="POST" action="/Socio/destroy">
		<p>Confirma borrado del socio <b><?= $socio->nombre ?></b>.</p>
		
		<input type="hidden" name="id" value ="<?= $socio->id ?>">
		<input class="button" type="submit" name="borrar" value="Borrar">
		
		</form>
		
		<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a>
			<a class="button" href="/socio/list">Lista de socios</a>
			<a class="button" href="/socio/show/<?= $socio->id?>">Detalles</a>
			<a class="button" href="/socio/edit/<?= $socio->id?>">Borrado</a>
		</div>



	<!-- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>
