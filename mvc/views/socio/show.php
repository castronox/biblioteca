<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalles del Socio - <?= $socio->nombre ?></title>

<!-- META -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Lista de libros de <?= APP_NAME ?>">
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
		
		<h2><?=$socio->nombre?> <?=$socio->apellidos?></h2>
		
		<p><b>Nombre</b>			<?= $socio->nombre 		?></p>
		<p><b>Apellidos</b>			<?= $socio->apellidos 	?></p>
		<p><b>DNI</b>				<?= $socio->dni 		?></p>
		<p><b>Nacimiento</b>		<?= $socio->nacimietno 	?></p>
		<p><b>Dirección</b>			<?= $socio->direccion 	?></p>
		<p><b>CP</b>				<?= $socio->cp 			?></p>
		<p><b>Población</b>			<?= $socio->poblacion 	?></p>
		<p><b>Provincia</b>			<?= $socio->provincia 	?></p>
		<p><b>Teléfono</b>			<?= $socio->telefono 	?></p>
		<p><b>Alta</b>				<?= $socio->alta 		?></p>	
		
						
						
		<div class="centrado">
		<a class="button" onclick="history.back()">Atrás</a>
		<a class="button" href="/socio/list">Lista de socios</a>
		<a class="button" href="/socio/edit/<?= $socio->id?>">Editar socio</a>
		<a class="button" href="/socio/delete/<?= $socio->id?>">Borrar socio</a>
		
		</div>
</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>

		