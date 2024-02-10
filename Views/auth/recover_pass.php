<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Ingresa tu E-mail para recibir un correo con el codigo de recuperación</p>

<form class="formulario" method="POST" action="/recover_pass">

    <div class="campo">
        <label class="label" for="email">Email:</label>
        <input  type="email" name="email" id="email" placeholder="Ingresa Tu Email">
    </div>
    
    <input class="boton-login" type="submit" value="Recuperar Password">
    
</form>
<div class="acciones">
    <a href="/crear_cuenta">¿Aún no tienes una cuenta? Crea Una</a>
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
</div>