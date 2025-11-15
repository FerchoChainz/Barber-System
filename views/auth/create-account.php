<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form action="/create-account" method="post" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
        type="text"
        id="nombre"
        name="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($user->nombre); ?>"
        >
    </div>

    <div class="campo">
        <label for="Apellido">Apellido</label>
        <input 
        type="text"
        id="apellido"
        name="apellido"
        placeholder="Tu Apellido"
        value="<?php echo s($user->apellido); ?>"
        >
    </div>

    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input 
        type="tel"
        id="telefono"
        name="telefono"
        placeholder="Tu Telefono"
        value="<?php echo s($user->telefono); ?>"
        >
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
        value="<?php echo s($user->email); ?>"
        >
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu password"
        >
    </div>

    <input type="submit" class="boton">

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesion.</a>
        <a href="/forget">¿Olvidaste tu contraseña?</a>
    </div>
</form>