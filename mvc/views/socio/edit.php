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
<?= (TEMPLATE)::getHeader('Editar socios')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>


<!--MIGAS-->

<?= (TEMPLATE)::getBreadCrumbs([

'Lista de socios' => '/Socio/list',
'Editar socio' => NULL,
]) ?>

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->
	
	
	
	<main class="">

		<h1><?= APP_NAME ?></h1>
		<h2>Edición del Socio <?= $socio->nombre?></h2>
	
	
	<div class="flex-container">
		<section class="flex1  centrado" >
			<form method="POST" class ="centrado" enctype="multipart/form-data" action="/Socio/update">

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
			
			<label>Perfil</label>
            <input type="file" name="foto" accept="image/*" id="file-with-preview" value="<?=old('perfil',$socio->perfil)?>">
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
			<br><br>
			
			
			<input class="button" type="submit" name="actualizar" value="Actualizar">
			
		</form>
		</section>
	<section class="flex1 centrado" >
	<script src="/js/Preview.js" ></script>
				
				<br>

				<figure class="flex1 centrado">
						
						<img src="<?= MEMBER_IMAGE_FOLDER. '/' .($socio->foto ?? DEFAULT_MEMBER_IMAGE)?>" id="preview-image" class="cover" alt="Previsualización del perfil de <?=$socio->nombre?>">
						<figcaption>Previsualización de la portada de <?=$socio->nombre?></figcaption>

						<form method="POST" action="/socio/dropPhoto">
							<input type="hidden" name="id" value="<?=$socio->id?>">
							<input type="submit" class="button" name="borrar" value="Eliminar portada">
						</form>
				</figure>

	</section>


		</div>
	
	
			<br><br><br><br>				
		<div class="centrado">
		<a class="button" onclick="history.back()">Atrás</a>
		<a class="button" href="/socio/list">Lista de socios</a>
		<a class="button" href="/socio/delete/<?= $socio->id ?>">Borrar socio</a>
		
		
		
		</div>
	
	<section>
					<h2>Prestamos de <?= $socio->nombre?></h2>
		<?php 
		if(!$prestamos){
			echo"<p>No hay Prestamos de este socio.</p>";
		}else{ ?>
			
		<table>
		<tr>
			<th>ID Prestamo</th><th>Obtención</th><th>Devolución</th><th>Incidencias</th><th>Operaciones</th>
		</tr>
		<?php foreach($prestamos as $prestamo){?>
					<tr>
					
					<td><?= $prestamo->id ?></td>	
					<td><?= $prestamo->prestamo ?></td>
					<td><?= $prestamo->devolucion ?></td>
				    <td><?= $prestamo->incidencia ?></td>
		<td>		
			<a href = '/Prestamo/devolucion/<?= $prestamo->id?>'>Devolver</a>
			
			
		</td>	
				    
			</tr>
		   <?php }?>
			</table>
		<?php }?>		
  		 <a class="button" href="/Prestamo/create/<?= $socio->id?>">Nuevo Prestamo</a>
	
	</section>
	</main>

	
	<!--------------------------------- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>