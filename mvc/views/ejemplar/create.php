<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de libros - <?= APP_NAME ?></title>

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
<?= (TEMPLATE)::getHeader('Lista de libros')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>
<h1><?= APP_NAME?></h1>

	<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	<main>


		<h2>Nuevo ejemplar</h2>

		<p>
			Estás a punbto de crear un nuevo ejemplar del libro <b><?= $libro->titulo?></b>.
		</p>

		<form method="POST" action="/Ejemplar/store">

			<input type="hidden" name="idlibro" value="<?= $libro->id?>"> <label>Año</label>
			<input type="text" name="anyo" value="<?= old('anyo')?>"> <br> <label>Precio</label>
			<input type="number" step="0.01" name="precio"
				value="<?=old('precio')?>"> <br> <label>Estado</label> <input
				type="text" name="estado" value="<?= old('estado')?>"> <br> <input
				type="submit" class="button" name="guardar" value="Guardar">

		</form>

		<div class="centrdo">
			<a class="button" onclick="history.back()">Atrás</a>
		</div>
	</main>
	<!-- FINALIZA ------------------------------------------ -->

<?=(TEMPLATE)::getFooter()?>
</body>
</html>
