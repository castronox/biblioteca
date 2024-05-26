<?php
Auth::oneRole(["ROLE_ADMIN", "ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Lista de temas - <?= APP_NAME ?></title>

	<!-- META -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Lista de temas en <?= APP_NAME ?>">
	<meta name="author" content="Cristian Castro">


	<!-- FAVICON -->
	<link rel="shortcut icon" href="/favicon.ico" type="image/png">


	<!-- CSS -->
	<?= (TEMPLATE)::getCss() ?>
</head>

<body>
	<?= (TEMPLATE)::getLogin() ?>
	<?= (TEMPLATE)::getHeader('Lista de temas') ?>
	<?= (TEMPLATE)::getMenu() ?>
	<?= (TEMPLATE)::getBreadCrumbs([

		'Temas' => '/Tema/list'
	]) ?>
	<?= (TEMPLATE)::getFlashes() ?>

	<main>

		<h1><?= APP_NAME ?></h1>
		<h2>Lista completa de temas </h2>

		<?php if ($filtro) {

			# El método removeFilterForm necesita conocer el filtro
			# y la ruta a la que se envía el formulario
			echo (TEMPLATE)::removeFilterForm($filtro, '/Tema/list');
		} else {


			echo (TEMPLATE)::filterForm(

				# Ruta a la que se envía el formulario
				'/Tema/list',
				# Lista de campos para "Buscar en"
				['ID' => 'id', 'Tema' => 'tema'],
				# Lista de campos para "ordenado por"
				['ID' => 'id', 'Tema' => 'tema'],
				# Valor por defecto para "Buscar en"
				'ID',
				# Valor por defecto para " Ordenado por"
				'ID'
			);
		} ?>

		<?php if ($temas) { ?>

			<div class="derecha">
				<?= $paginator->stats() ?>
			</div>

			<table>

				<tr>
					<th>ID</th>
					<th>Tema</th>
					<th>Descripción</th>
					<th>Operaciones</th>
				</tr>


				<?php foreach ($temas as $tema) { ?>

					<tr>
						<td><?= $tema->id ?></td>
						<td><?= $tema->tema ?></td>
						<td><?= $tema->descripcion ?></td>

						<td>
							<a href='/Tema/show/<?= $tema->id ?>'>| Mostrar |</a>
							<a href='/Tema/edit/<?= $tema->id ?>'>Actualizar |</a>
							<a href='/Tema/delete/<?= $tema->id ?>'>Borrar | </a>
						</td>
					</tr>

				<?php } ?>
			</table>
			<?= $paginator->ellipsisLinks() ?>
		<?php } else { ?>
			<p> No hay Temas que mostrar.</p>

		<?php } ?>

	</main>

	<?= (TEMPLATE)::getFooter() ?>
</body>

</html>