<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Detalles del Libro - <?= $libro->titulo ?></title>

<!-- META -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Lista de libros de <?= APP_NAME ?>">
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

		<div class="flex-container">
			<section class="flex1">
		<h2><?=$libro->titulo?></h2>


		<p>
			<b>ISBN:</b>				<?= $libro->isbn?></p>
		<p>
			<b>Título:</b>				<?= $libro->titulo?></p>
		<p>
			<b>Editorial:</b>		    <?= $libro->editorial?></p>
		<p>
			<b>Autor:</b>				<?= $libro->autor?></p>
		<p>
			<b>Idioma:</b>				<?= $libro->idioma?></p>
		<p>
			<b>Edición:</b>				<?= $libro->edicion?></p>

		<p>
			<b>Edad recomendada:</b>
<?= $libro->edadrecomendada ?? 'Pendiente de calificación';?></p>
</section>

<figure class="flex1 centrado">

	<img src="<?= BOOK_IMAGE_FOLDER.'/'.($libro->portada ?? DEFAULT_BOOK_IMAGE)?>" class="cover" alt="Portada de <?=$libro->titulo?>">
	<figcaption>Portada de <?="$libro->titulo, de $libro->autor"?></figcaption>

</figure>

</div>
<br><br><hr><br>
		<div class="centrado">
			<a class="button" onclick="history.back()">Atrás</a> <a
				class="button" href="/libro/list">Lista de libros</a>
				<?php if (Login::oneRole(['ROLE_LIBRARIAN','ROLE_ADMIN'])){ ?>
				<a
				class="button" href="/libro/edit/<?= $libro->id?>">Edición</a> <a
				class="button" href="/libro/delete/<?= $libro->id?>">Borrado</a>

				<?php } ?>
		</div>
		<br>
		<?php if (Login::oneRole(['ROLE_LIBRARIAN','ROLE_ADMIN'])){ ?>
		<hr>

		<section>
		<h2>Temas tratados por <?= $libro->titulo?></h2>
		
		<?php 
		if(!$temas){
			echo "No se han indicado temas para este libro";
		}else{?>
		
		<table>
				<tr>
					<th>ID</th><th>Tema</th>
				</tr>
				<?php 
				foreach($temas as $tema){
				
					echo "<tr><td>$tema->id</td>";
					echo "<td>$tema->tema</td></tr>";
				}
				
				?>						
			</table>		
		<?php }?>		
	</section>
		
		
		
		<section>
		<h2>Ejemplares de <?= $libro->titulo?></h2>
		<?php 
		if(!$ejemplares){
			echo"<p>No hay ejemplares de este libro.</p>";
		}else{ ?>
			
		<table>
		<tr>
			<th>ID</th><th>Año</th><th>Precio</th><th>Estado</th>
		</tr>
		<?php 
		foreach($ejemplares as $ejemplar){
			echo "<tr><td>$ejemplar->id</td>";	
			echo "<td>$ejemplar->anyo</td>";
			echo "<td>$ejemplar->precio</td>";
			echo "<td>$ejemplar->estado</td>";			
			}	
		    ?>
		</table>		
  <?php 	}?>

		</section>

<?php } ?>
	</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>


