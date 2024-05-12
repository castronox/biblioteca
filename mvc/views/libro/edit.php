<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Edición de libros - <?= APP_NAME ?></title>

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

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->


	<main>

		<h1><?= APP_NAME ?></h1>
		<h2>Edición del libro <?= $libro->titulo?></h2>

		<form method="POST" action="/Libro/update">

			<!-- Input oculto que contiene el ID del libro a actualizar -->

			<input type="hidden" name="id" value ="<?= $libro->id ?>">
			
			<!-- Resto del formulario -->
			
			<label>ISBN</label>
			<input type="text" name="isbn" value="<?= old('isbn',$libro->isbn)?>">
			<br>
			
			<label>Título</label>
			<input type="text" name="titulo" value="<?= old('titulo',$libro->titulo)?>">
			<br>
			
			<label>Editorial</label>
			<input type="text" name="editorial" value="<?= old('editorial',$libro->editorial)?>">
			<br>
			
			<label>Autor</label>
			<input type="text" name="autor" value="<?= old('autor',$libro->autor)?>">
			<br>
			
			<label>Idioma</label>
			<input type="text" name="idioma" value="<?= old('idioma',$libro->idioma)?>">
			<br>
			
			<label>Edición</label>
			<input type="text" name="edicion" value="<?= old('edicion',$libro->edicion)?>">
			<br>
			
			<label>Edad</label>
			<input type="text" name="edad" value="<?= old('edad',$libro->edad)?>">
			<br>
			
			<input class="button" type="submit" name="actualizar" value="Actualizar">
 			
		</form>
		
				<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> 
			<a class="button" href="/libro/list">Lista de libros</a> 
			<a class="button" href="/libro/show/<?= $libro->id?>">Detalles</a>
			<a class="button" href="/libro/delete/<?= $libro->id?>">Borrado</a>
			 
		</div>
		
		<section>
		
		<script>
			function confirmar(id){
				if(confirm('Seguro que deseas eliminar?'))
					location.href = '/Ejemplar/destroy/'+id
					
			}		
		</script>
		
		<h2>Ejemplares de <?= $libro->titulo?></h2>
		
		<?php 
		if(!$ejemplares){
			echo"<p>No hay ejemplares de este libro.</p>";
		}else{ ?>			
		  <table>
		<tr>
			<th>ID</th><th>Año</th><th>Precio</th><th>Estado</th><th>Operaciones</th>
		</tr>
		<?php foreach($ejemplares as $ejemplar){?>
					<tr>
					
					<td><?= $ejemplar->id ?></td>	
					<td><?= $ejemplar->anyo ?></td>
					<td><?= $ejemplar->precio ?></td>
				    <td><?= $ejemplar->estado ?></td>
				    <td class="centrado">
		    
		  	<?php if (!$ejemplar->hasAny('Prestamo')) {?>
		    <a class="button" onclick="confirmar(<?= $ejemplar->id?>)">Eliminar</a>		    	
				
			<?php }	?>
			</td>
			</tr>
		   <?php }?>
			</table>		
  		 <?php }?>
		
		<a class="button" href="/Ejemplar/create/<?= $libro->id?>">Nuevo ejemplar</a>
		
		</section>

	</main>
	
	
	
	


	<!--------------------------------- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>

