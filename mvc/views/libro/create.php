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
	<?= (TEMPLATE)::getCss() ?>
</head>

<body>
	<?= (TEMPLATE)::getLogin() ?>
	<?= (TEMPLATE)::getHeader('Crear nuevo libro') ?>
	<?= (TEMPLATE)::getMenu() ?>
	<?= (TEMPLATE)::getFlashes() ?>

	<!-- MIGAS -->
	<?= (TEMPLATE)::getBreadCrumbs([
	
	'Inicio' => '/',
	'Crear Libro' => NULL,
	]) ?>

	<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	<main>

		<h1><?= APP_NAME ?></h1>
		<h2>Nuevo libro</h2>
		<div class="flex-container">
			<section class="flex1 centrado">
				<form method="POST" enctype="multipart/form-data" action="/Libro/store">
					<label>ISBN</label>
					<input type="text" name="isbn" value="<?= old('isbn') ?>">
					<br>
					<label>Titulo</label>
					<input type="text" name="titulo" value="<?= old('titulo') ?>">
					<br>
					<label>Editorial</label>
					<input type="text" name="editorial" value="<?= old('editorial') ?>">
					<br>
					<label>Autor</label>
					<input type="text" name="autor" value="<?= old('autor') ?>">
					<br><br>
<hr><br>
					<label>Portada</label>
					<input type="file" name="portada" accept="image/*" id="file-with-preview">
	<br>
					<label>Idioma:</label>
					<select name="idioma">
						<option value="Castellano" <?= oldSelected('idioma', 'Castellano') ?>>Castellano</option>
						<option value="Catalán" <?= oldSelected('idioma', 'Catalán') ?>>Catalán</option>
						<option value="Otros" <?= oldSelected('idioma', 'Otros') ?>>Otros</option>
				</select><br><br>
<hr><br>

					<label>Edición</label>
					<input type="number" name="edicion" value="<?= old('edicion') ?>">
					<br>

					<label>Edad</label>
					<input type="number" name="edadrecomendada" value="<?= old('edadrecomendada') ?>">
					<br>


					<label>Tema</label>
					<select name="idtema">

						<?php
						foreach ($listaTemas as $nuevoTema)
							echo "<option value ='$nuevoTema->id'>$nuevoTema->tema</option>";
						?>

					</select>

					<p> Puede añadir temas posteriormente, desde la opcion editar libro.</p>



					<input type="submit" class="button" name="guardar" value="Guardar">
				</form>
			</section>
			<section class="flex1 centrado">
				<script src="/js/Preview.js" ></script>
				
					<br>

					<figure class="flex1 centrado">
							<img src="<?= BOOK_IMAGE_FOLDER.'/'.DEFAULT_BOOK_IMAGE?>" id="preview-image" class="cover" alt="Previsualización de la portada">
							<figcaption>Previsualización de la portada</figcaption>
					</figure>
			</section>
		</div>
		<br><br>
		<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a class="button" href="/libro/list">Lista de
				libros</a>
		</div>

	</main>
	<!-- FINALIZA ------------------------------------------ -->


	<?= (TEMPLATE)::getFooter() ?>
</body>

</html>