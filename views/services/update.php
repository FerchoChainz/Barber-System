<h1 class="nombre-pagina">Actualizar Servicio</h1>

<p class="descripcion-pagina">Llena correctamente todos los campos del formulario</p>

<?php //include_once __DIR__ . '/../templates/barra.php' ?>
<?php include_once __DIR__ . '/../templates/alerts.php' ?>


<form method="POST" class="formulario">
    <!-- Para actualizar eliminamos el action para que lo mande a la misma url y no pierda la referencia -->

    <?php include_once __DIR__ . '/form.php' ?>

    <input type="submit" class="boton" value="Guardar Servicio">
</form>