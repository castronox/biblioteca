<!DOCTYPE html>
<html lang='es'>
<head>
<meta charset='UTF-8'>
<title> Editar Usuario <?=$user->displayname?> </title>

<!-- META -->
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='description' content='Lista de libros de <?= APP_NAME ?>'>
<meta name='author' content='Cristian Castro'>


<!-- FAVICON -->
<link rel='shortcut icon' href='/favicon.ico' type='image/png'>


<!-- CSS -->
<?= (TEMPLATE)::getCss()?>
</head>
<body>
<?=(TEMPLATE)::getLogin()?>
<?= (TEMPLATE)::getHeader('AÑADE AQUÍ EL HEADER')?>
<?=(TEMPLATE)::getMenu()?>
<?=(TEMPLATE)::getFlashes()?>

<main>
<h1><?= APP_NAME ?></h1>





</main>

<?=(TEMPLATE)::getFooter()?>
</body>
</html>