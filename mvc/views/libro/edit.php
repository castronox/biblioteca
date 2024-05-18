<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Edición de libros - <?= APP_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME ?>">
    <meta name="author" content="Cristian Castro">
    <link rel="shortcut icon" href="/favicon.ico" type="image/png">
    <?= (TEMPLATE)::getCss() ?>
</head>
<body>
    <?= (TEMPLATE)::getLogin() ?>
    <?= (TEMPLATE)::getHeader('Lista de libros') ?>
    <?= (TEMPLATE)::getMenu() ?>
    <?= (TEMPLATE)::getFlashes() ?>

    <main>
        <h1><?= APP_NAME ?></h1>
        <h2 class="centrado">Edición del libro <?= $libro->titulo ?></h2><br>
        <script src="/js/preview.js"></script>
		<div class="flex-container">
        <form method="POST" class="flex1" enctype="multipart/form-data" action="/Libro/update">
            <div class="flex-container centrado">
                <section class="flex1 centrado">
                    <input type="hidden" name="id" value="<?= $libro->id ?>">
                    <br><br>
                    <label>ISBN</label>
                    <input type="text" name="isbn" value="<?= old('isbn', $libro->isbn) ?>"><br>
                    <label>Título</label>
                    <input type="text" name="titulo" value="<?= old('titulo', $libro->titulo) ?>"><br>
                    <label>Editorial</label>
                    <input type="text" name="editorial" value="<?= old('editorial', $libro->editorial) ?>"><br>
                    <label>Autor</label>
                    <input type="text" name="autor" value="<?= old('autor', $libro->autor) ?>"><br>
                    <label>Idioma</label>
                    <input type="text" name="idioma" value="<?= old('idioma', $libro->idioma) ?>"><br>
                    <label>Edición</label>
                    <input type="text" name="edicion" value="<?= old('edicion', $libro->edicion) ?>"><br>
                    <label>Edad</label>
                    <input type="text" name="edad" value="<?= old('edad', $libro->edad) ?>"><br>
                    <label>Portada</label>
                    <input type="file" name="portada" accept="image/*" id="file-with-preview"><br><br><br><br>
                    <input class="button" type="submit" name="actualizar" value="Actualizar">
                </section>
            </div>
        </form>

        <section class="flex1 centrado">
            <figure class="flex1 centrado">
                <img src="<?= BOOK_IMAGE_FOLDER . '/' . ($libro->portada ?? DEFAULT_BOOK_IMAGE) ?>" class="cover" id="preview-image" alt="Portada de <?= $libro->titulo ?>">
                <figcaption>Portada de <?= "$libro->titulo, de $libro->autor" ?></figcaption>
                <form method="post" action="/Libro/dropcover">
                    <input type="hidden" name="id" value="<?= $libro->id ?>">
                    <input type="submit" class="button" name="borrar" value="Eliminar portada">
                </form>
            </figure>
        </section>
</div>
        <br><br><br>
        <div class="centrado">
            <a class="button" onclick="history.back()">Atrás</a>
            <a class="button" href="/libro/list">Lista de libros</a>
            <a class="button" href="/libro/show/<?= $libro->id ?>">Detalles</a>
            <a class="button" href="/libro/delete/<?= $libro->id ?>">Borrado</a>
        </div>

        <hr>
        <section>
            <h2 class="centrado">Temas tratados por <?= $libro->titulo ?></h2>
            <?php if (!$temas): ?>
                <p>No se han indicado temas para este libro</p>
            <?php else: ?>
                <table class="centrado">
                    <tr>
                        <th>ID</th>
                        <th>Tema</th>
                        <th>Operaciones</th>
                    </tr>
                    <?php foreach ($temas as $tema): ?>
                        <tr>
                            <td><?= $tema->id ?></td>
                            <td><?= $tema->tema ?></td>
                            <td class="centrado">
                                <form method="POST" action="/Libro/removetema">
                                    <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                                    <input type="hidden" name="idtema" value="<?= $tema->id ?>">
                                    <input type="submit" class="button" name="remove" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>

            <br>
            <form class="centrado" method="POST" action="/Libro/addtema">
                <input type="hidden" name="idlibro" value="<?= $libro->id ?>">
                <select name="idtema">
                    <?php foreach ($listaTemas as $nuevoTema): ?>
                        <option value="<?= $nuevoTema->id ?>"><?= $nuevoTema->tema ?></option>
                    <?php endforeach; ?>
                </select>
                <input class="button" type="submit" name="add" value="Añadir tema">
            </form>
        </section>

        <hr>
        <section class="flex1 centrado">
            <script>
                function confirmar(id) {
                    if (confirm('Seguro que deseas eliminar?'))
                        location.href = '/Ejemplar/destroy/' + id
                }		
            </script>
            <h2>Ejemplares de <?= $libro->titulo ?></h2>
            <?php if (!$ejemplares): ?>
                <p>No hay ejemplares de este libro.</p>
            <?php else: ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Año</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Operaciones</th>
                    </tr>
                    <?php foreach ($ejemplares as $ejemplar): ?>
                        <tr>
                            <td><?= $ejemplar->id ?></td>
                            <td><?= $ejemplar->anyo ?></td>
                            <td><?= $ejemplar->precio ?></td>
                            <td><?= $ejemplar->estado ?></td>
                            <td class="centrado">
                                <?php if (!$ejemplar->hasAny('Prestamo')): ?>
                                    <a class="button" onclick="confirmar(<?= $ejemplar->id ?>)">Eliminar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            <a class="button" href="/Ejemplar/create/<?= $libro->id ?>">Nuevo ejemplar</a>
        </section>
    </main>
    <?= (TEMPLATE)::getFooter() ?>
</body>
</html>
