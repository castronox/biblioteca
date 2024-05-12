<!DOCTYPE html>
<html lang="es">
<head>
<meta charset ="UTF-8">
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
<?= (TEMPLATE)::getHeader('Lista de socios')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<main>
	
	<h1><?= APP_NAME ?></h1>
	
	<h2>Lista de socios</h2>
	
	<table>
	
	<tr>
			<th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Población</th><th>Operaciones</th>
	</tr>
	
	<?php  foreach ($socios as $socio){?>
	
	<tr>
		<td><?= $socio->dni?></td>
		<td><?= $socio->nombre?></td>
		<td><?= $socio->apellidos?></td>
		<td><?= $socio->poblacion?></td>
		
		<td>		
			<a href = '/Socio/show/<?= $socio->id?>'>Ver</a>
			<a href = '/Socio/edit/<?= $socio->id?>'>Editar</a>
			<a href = '/Socio/delete/<?= $socio->id?>'>Borrar</a>
		</td>	
	</tr>
	
	<?php }?>
	
	</table>













</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>





