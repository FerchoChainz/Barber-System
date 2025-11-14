<h1 class="nombre-pagina">Olvide mi Password</h1>
<p class="descripcion-pagina">Restablece tu password ingresando tu email</p>

<form action="/forget" method="post" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"
        placeholder="Tu email"
        id="email"
        name="email"
        >
    </div>

    <input type="submit" class="boton" value="Enviar instrucciones">

    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesion.</a>
        <a href="/create-account">¿Aun no tienes una cuenta? Crea una.</a>
    </div>
</form>