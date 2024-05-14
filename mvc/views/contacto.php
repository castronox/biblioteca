<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Contactos <?= APP_NAME ?></title>

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

<!-- AQUI VA EL MAIN DE LA NUEVA VISTA DEL MÉTODO -->


	<main>
	
		<div clas="flex-container">
			<section class="flex1">
				<h2>Contacto</h2>
					<p>Utiliza el formulario de contacto para enviar un mensaje al administrado de <?= APP_NAME ?>.</p>
					
						
						<form method="POST" action ="/Contacto/send">
						
							<label>Email:</label>
								<input type="email" name="email" required value="<?= old ('email')?>">
									<br>						
							
							<label>Nombre:</label>
								<input type="text" name="nombre" required value="<?= old ('nombre')?>">
									<br>	
							
							<label>Asunto:</label>
								<input type="text" name="asunto" required value="<?= old ('asunto')?>">
									<br>	
							
							<label>Mensaje:</label>
								<input type="textarea" name="mensaje" required value="<?= old ('mensaje')?>">
									<br>
							
							<input class="button" type="submit" name="enviar" value="Enviar">
								
						</form>
									
			</section>	
			
			<section class="flex1">
			
				<h2> Ubicación y mapa</h2>
				<iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11932.135825975482!2d1.834275545273731!3d41.611777390355215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4f56ed1c19333%3A0x7a64bc44b3ba714f!2s08691%20Monistrol%20de%20Montserrat%2C%20Barcelona!5e0!3m2!1ses!2ses!4v1715722122311!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			
				<h3>Datos:</h3>
				
				<p><b>Cristian Castro</b> - Plaça de la font gran, 08691 Monistrol de Montserrat <br>
										  - Teléfono : xxx-xxx-xxx
										  
			</section>
		</div>
		
		<div class ="centrado"> <a class="button" onclick="history.back()">Atrás</a></div>
	
	
	</main>
	

	<!--------------------------------- FINALIZA ------------------------------------------ -->


<?=(TEMPLATE)::getFooter()?>
</body>
</html>

	