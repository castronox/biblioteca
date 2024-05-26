<?php
Auth::oneRole(["ROLE_ADMIN","ROLE_LIBRARIAN"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset ="UTF-8">
<title>Lista de Socios - <?= APP_NAME ?></title>

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

<!-- MIGAS -->
<?=(TEMPLATE)::getBreadCrumbs([

'Socio'=> '/Socio/list'
])  ?>
<?=(TEMPLATE)::getFlashes()?>

<main>
	
	<h1><?= APP_NAME ?></h1>
	
	<h2>Lista de socios</h2>
	
	<?php
	
	if ($filtro){
		
		# El método removeFilterForm necesita conocer el Filtro		
		# y la ruta a la que se envia el formulario.
		
		echo (TEMPLATE)::removeFilterForm($filtro, '/Socio/list');
	}else{
		
		echo (TEMPLATE)::filterForm(
				
					# Ruta a la que se envía el formulario
			'/Socio/list',
					# Lista de campos para "Buscar en"
			['Nombre' => 'nombre', 'Poblacion' => 'poblacion', 'Apellidos' => 'apellidos' ],
					# Lista de campos para "Ordenado por"
			['Nombre' => 'nombre', 'Poblacion' => 'poblacion', 'Apellidos' => 'apellidos' ],
					
					# Valor por defecto para "Buscar en"
					'Nombre',
					# Valor por defecto para "Ordenado por"
					'Titulo'				
				);
	}?>
	
		<?php if ($socios){?>
		
			<div class="derecha">
				<?= $paginator->stats()?>
			</div>
	
	<table>
	
	<tr>
			<th>Foto</th><th>DNI</th><th>Nombre</th><th>Apellidos</th><th>Población</th><th>Operaciones</th>
	</tr>
	
	<?php  foreach ($socios as $socio){?>
	
	<tr class="centrado">
		<!--En este PRIMER Table Data añadimos la imágen de perfil. -->

		<td class="centrado">
			<img src="<?= MEMBER_IMAGE_FOLDER. '/'. ($socio->foto ?? DEFAULT_MEMBER_IMAGE)?>" class="cover-mini" alt="Portada de <?=$socio->nombre?>">
		</td>

		<td><?= $socio->dni?></td>
		<td><?= $socio->nombre?></td>
		<td><?= $socio->apellidos?></td>
		<td><?= $socio->poblacion?></td>
		
		<td>		
			<a href = '/Socio/show/<?= $socio->id?>'>Ver</a>
			<a href = '/Socio/edit/<?= $socio->id?>?from=list'>Editar</a>
			<a href = '/Socio/delete/<?= $socio->id?>?from=list'>Borrar</a>
		</td>	
	</tr>
	
	<?php }?>	
	</table>
	<?= $paginator->ellipsisLinks() ?>
	<?php }else{?>
	<p>No hay libros que mostrar.</p>
	<?php }?>













</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>





