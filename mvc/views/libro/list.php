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
	<?= (TEMPLATE)::getCss() ?>
</head>

<body>
	<?= (TEMPLATE)::getLogin() ?>
	<?= (TEMPLATE)::getHeader('Lista de libros') ?>
	<?= (TEMPLATE)::getMenu() ?>
	<?= (TEMPLATE)::getBreadCrumbs([

		'Libros' => '/Libro/list',
		'Nuevo' => NULL,
	]) ?>

	<?= (TEMPLATE)::getFlashes() ?>

	<main>

		<h1><?= APP_NAME ?></h1>
		<h2>Lista completa de libros </h2>

		<?php if ($filtro) {
			# El método removeFilterForm necesita conocer el filtro
			# y la ruta a la que se envía el formulario
			echo (TEMPLATE)::removeFilterForm($filtro, '/Libro/list');

		} else {

			echo (TEMPLATE)::filterForm(
				# Ruta a la que se envía el formulario
				'/Libro/list',
				# Lista de campos para "Buscar en"
				['Titulo' => 'titulo', 'Editorial' => 'editorial', 'Autor' => 'autor'],
				# Lista de campos para "ordenado por"
				['Titulo' => 'titulo', 'Editorial' => 'editorial', 'Autor' => 'autor'],
				# Valor por defecto para "Buscar en"		
				'Autor',
				# Valor por defecto para " Ordenado por"
				'Título'

			);
		} ?>

		<?php if ($libros) { ?>

			<div class="derecha">
				<?= $paginator->stats() ?>
			</div>

			<table>

				<tr>
					<th>Título</th>
					<th>Autor</th>
					<th>Editorial</th>
					<th>Operaciones</th>
				</tr>

				<?php foreach ($libros as $libro) { ?>

					<tr>

						<td><?= $libro->titulo ?></td>
						<td><?= $libro->autor ?></td>
						<td><?= $libro->editorial ?></td>

						<td>
							<a href='/Libro/show/<?= $libro->id ?>'>Ver</a> -
							<a href='/Libro/edit/<?= $libro->id ?>'>Actualizar</a> -
							<a href='/Libro/delete/<?= $libro->id ?>'>Borrar</a>
						</td>
					</tr>
				<?php } ?>
			</table>
			<?= $paginator->ellipsisLinks() ?>
		<?php } else { ?>
			<p>No hay libros que mostrar.</p>
		<?php } ?>

	</main>

	<?= (TEMPLATE)::getFooter() ?>
</body>

</html>