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

<main>
		<h1><?= APP_NAME ?></h1>
		<h2><?=$libro->titulo?></h2>


		<p>
			<b>ISBN:</b>				<?= $libro->isbn?></p>
		<p>
			<b>Título:</b>				<?= $libro->titulo?></p>
		<p>
			<b>Editorial:</b>		    <?= $libro->editorial?></p>
		<p>
			<b>Autor:</b>				<?= $libro->autor?></p>
		<p>
			<b>Idioma:</b>				<?= $libro->idioma?></p>
		<p>
			<b>Edición:</b>				<?= $libro->edicion?></p>

		<p>
			<b>Edad recomendada:</b>
<?= $libro->edadrecomendada ?? 'Pendiente de calificación';?></p>


		<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a
				class="button" href="/libro/list">Lista de libros</a> <a
				class="button" href="/libro/edit/<?= $libro->id?>">Edición</a> <a
				class="button" href="/libro/delete/<?= $libro->id?>">Borrado</a>
		</div>


	</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>


