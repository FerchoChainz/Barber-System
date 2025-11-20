<h1 class="nombre-pagina">Recuperar contraseña.</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuacion: </p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<?php if($error) return null ?>

<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password:</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Ingresa tu nuevo password"
        >
    </div>

    <input type="submit" value="Guardar nuevo password" class="boton">

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesion.</a>
        <a href="/create-account">¿Aún no tienes una cuenta? Crea una.</a>
    </div>
</form>