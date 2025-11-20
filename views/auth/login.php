<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Incia Sesion con tus datos.</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            placeholder="Ingresa tu Email"
            id="email"
            name="email"
        />
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

    <input type="submit" value="Iniciar Sesion" class="boton">
</form>

<div class="acciones">
    <a href="/create-account">¿Aun no tienes una cuentra? Crea una.</a>
    <a href="/forget">¿Olvidaste tu contraseña?</a>
</div>