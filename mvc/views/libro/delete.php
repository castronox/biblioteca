<?php
Auth::oneRole(["ROLE_ADMIN","ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Borrar el libro - <?= $libro->titulo?></title>

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



<!-- MIGAS -->

<?php
// Detectar el origen de la navegación desde la URL o cualquier otra fuente
$from = $_GET['from'] ?? 'show'; // Por defecto es 'show' si no se especifica

// Definir las migas de pan
$migas = [
    'Inicio' => '/',
    'Lista de libros' => '/Libro/list',
];

if ($from === 'list') {
    $migas["Borrar libro $libro->id"] = NULL;
} else {
    // Asumimos que el origen es 'show' o cualquier otro valor
    $migas["Mostrar libro $libro->id"] = "/Libro/show/$libro->id";
    $migas["Borrar libro $libro->id"] = NULL;
}
?>
<?= (TEMPLATE)::getBreadCrumbs($migas) ?>

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->


		<h1><?= APP_NAME ?></h1>
		<h2>Borrado del libro <?= $libro->titulo?></h2>

		<form method="POST" action="/Libro/destroy">
		<p>Confirma borrado del libro <b><?= $libro->titulo ?></b>.</p>
		
		<input type="hidden" name="id" value ="<?= $libro->id ?>">
		<input class="button" type="submit" name="borrar" value="Borrar">
		
		</form>
		
						<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a
				class="button" href="/libro/list">Lista de libros</a> <a
				class="button" href="/libro/show/<?= $libro->id?>">Detalles</a> <a
				class="button" href="/libro/edit/<?= $libro->id?>">Borrado</a>
		</div>

	<!-- FINALIZA -------------------------------------------->

<?=(TEMPLATE)::getFooter()?>
</body>
</html>
