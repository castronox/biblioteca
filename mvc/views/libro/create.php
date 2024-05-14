<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear nuevo libro <?= APP_NAME ?></title>

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
<?= (TEMPLATE)::getHeader('Crear nuevo libro')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	<main>

		<h1><?= APP_NAME?></h1>
		<h2>Nuevo libro</h2>

		<form method="POST" action="/libro/store">
			<label>ISBN</label> 
			<input type="text" name="isbn" value="<?= old('isbn')?>"> 
			
			<label>Titulo</label> 
			<input type="text" name="titulo" value="<?= old('titulo')?>"> 
			
			<label>Editorial</label>
			<input type="text" name="editorial" value="<?= old('editorial')?>"> 
			
			<label>Autor</label>
			<input type="text" name="autor" value="<?= old('autor')?>"> 
			
			
			<label>Idioma:</label>
			<select name="idioma">
				<option value="Castellano"  <?= oldSelected('idioma', 'Castellano')?>>Castellano</option>
				<option value="Catalán" 	<?= oldSelected('idioma', 'Catalán')?>>Catalán</option>
				<option value="Otros" 		<?= oldSelected('idioma', 'Otros')?>>Otros</option>
			</select><br>
			
			
			<label>Edición</label> 
			<input type="number" name="edicion" value="<?= old('edicion')?>"> 
			<br> 
			
			<label>Edad</label>
			<input type="number" name="edadrecomendada"	value="<?= old('edadrecomendada')?>"> 
			<br> 
			
			
			<label>Tema</label>
			<select name="idtema">
			
					<?php
					foreach($listaTemas as $nuevoTema)	
							echo "<option value ='$nuevoTema->id'>$nuevoTema->tema</option>";					
					?>
			
			</select>
			
			<p> Puede añadir temas posteriormente, desde la opcion editar libro.</p>
			
			
			
			<input type="submit" class="button" name="guardar" value="Guardar">
		</form>

		<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a
				class="button" href="/libro/list">Lista de libros</a>
		</div>

	</main>
	<!-- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>


