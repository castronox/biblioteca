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
		
		
		
		
			<!-- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>

		
