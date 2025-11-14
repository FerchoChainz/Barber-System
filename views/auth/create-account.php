<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario</p>

<form action="/create-account" method="post" class="formulario">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
        type="text"
        id="nombre"
        name="nombre"
        placeholder="Tu Nombre"
        >
    </div>

    <div class="campo">
        <label for="Apellido">Apellido</label>
        <input 
        type="text"
        id="Apellido"
        name="Apellido"
        placeholder="Tu Apellido"
        >
    </div>

    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input 
        type="tel"
        id="Telefono"
        name="Telefono"
        placeholder="Tu Telefono"
        >
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input 
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
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