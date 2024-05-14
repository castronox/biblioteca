<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear nuevo Socio <?= APP_NAME ?></title>

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
<?= (TEMPLATE)::getHeader('Crear socio')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	<main>

		<h1><?= APP_NAME?></h1>
		<h2>Nuevo Socio</h2>
		
		<form method="POST" action="/socio/store">
		
		<label>DNI:</label>
		<input type="text" name="dni" value="<?= old('dni')?>">
		
		<label>Nombre:</label>
		<input type="text" name="nombre" value="<?= old('nombre')?>">
				
		<label>Apellidos:</label>
		<input type="text" name="apellidos" value="<?= old('apellidos')?>">
		<br><br><br>
		
		<label>Nacimiento</label>
		<input type="date" name="nacimiento" value="<?= old('nacimiento')?>">
				
		<label>Email</label>
		<input type="email" name="email" value="<?= old('email')?>">
		
		<label>Dirección</label>
		<input type="text" name="direccion" value="<?= old('direccion')?>">
		<br><br><br>
		<label>CP:</label>
		<input type="number" name="cp" value="<?= old('cp')?>">
		
		<label>Población</label>
		<input type="text" name="poblacion" value="<?= old('poblacion')?>">
		
		<label>Provincia</label>
		<input type="text" name="provincia" value="<?= old('provincia')?>">
		<br><br><br>
		
		<label>Teléfono:</label>
		<input type="number" name="telefono" value="<?= old('telefono')?>">
		
		<div class="centrado">
		<input type="submit" class="button" name="guardar" value="Guardar">
		</div>
		
		
		</form>
		
		
				<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a
				class="button" href="/socio/list">Lista de socios</a>
		</div>
		
			<!-- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>

		
