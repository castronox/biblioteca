<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Edición de Socios - <?= APP_NAME ?></title>

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

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	
	
	
	<main>

		<h1><?= APP_NAME ?></h1>
		<h2>Edición del Socio <?= $socio->titulo?></h2>
	
	
	
			<form method="POST" action="/Socio/update">

			<!-- Input oculto que contiene el ID del libro a actualizar -->

			<input type="hidden" name="id" value ="<?= $socio->id ?>">
			
			<!-- Resto del formulario -->
			
			<label>DNI</label>
			<input type="text" name="dni" value="<?= old('dni',$socio->dni)?>">
			<br>
			
			
			<label>Nombre</label>
			<input type="text" name="nombre" value="<?= old('nombre',$socio->nombre)?>">
			<br>
			
			<label>Apellidos</label>
			<input type="text" name="apellidos" value="<?= old('apellidos',$socio->apellidos)?>">
			<br>
			
			<label>Nacimiento</label>
			<input type="text" name="nacimiento" value="<?= old('nacimiento',$socio->nacimiento)?>">
			<br>
			
			<label>Email</label>
			<input type="text" name="email" value="<?= old('email',$socio->email)?>">
			<br>
			
			<label>Dirección</label>
			<input type="text" name="direccion" value="<?= old('direccion',$socio->direccion)?>">
			<br>
			
			<label>CP</label>
			<input type="text" name="cp" value="<?= old('cp',$socio->cp)?>">
			<br>
			
			<label>Poblacion</label>
			<input type="text" name="poblacion" value="<?= old('poblacion',$socio->poblacion)?>">
			<br>
			
			<label>Provincia</label>
			<input type="text" name="provincia" value="<?= old('provincia',$socio->provincia)?>">
			<br>
			
			<label>Teléfono</label>
			<input type="text" name="telefono" value="<?= old('telefono',$socio->telefono)?>">
			<br>
			
			
			<input class="button" type="submit" name="actualizar" value="Actualizar">
 			
		</form>
	
	
	
							
		<div class="centrado">
		<a class="button" onclick="history.back()">Atrás</a>
		<a class="button" href="/socio/list">Lista de socios</a>
		<a class="button" href="/socio/edit/<?= $socio->id?>">Editar socio</a>
		<a class="button" href="/socio/delete/<?= $socio->id?>">Borrar socio</a>
		
		</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<!--------------------------------- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>