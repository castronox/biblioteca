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
<?= (TEMPLATE)::getHeader('Lista de libros')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<main>
	
	<h1><?= APP_NAME ?></h1>
	<h2>Lista completa de libros </h2>
	
	<table>
	
	<tr>
		<th>Título</th><th>Autor</th><th>Editorial</th><th>Operaciones</th>
	</tr>
	
	<?php foreach ($libros as $libro){?>
	
		<tr>
		
    		<td><?=$libro->titulo?></td>
    		<td><?=$libro->Autor?></td>
    		<td><?=$libro->Editorial?></td>
    			
    		<td>
    			<a href ='/Libro/show/<?= $libro->id?>'>Ver</a> -
    			<a href ='/Libro/edit/<?= $libro->id?>'>Actualizar</a> -
    			<a href ='/Libro/delete/<?= $libro->id?>'>Borrar</a> 
    		</td>
		</tr>
		<?php }?>	
	</table>
	
	
</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>






