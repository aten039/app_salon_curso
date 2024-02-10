<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form class="formulario" method="post" action="/crear_cuenta">

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" id="nombre">
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Tu apellido" id="apellido">
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Tu telefono" id="telefono">
    </div>
    <div class="campo">
        <label for="email">E-mail:</label>
        <input type="email" name="email"  placeholder="Tu E-mail" id="email">
    </div>
   
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" name="password"  placeholder="Tu Contraseña" id="password">
    </div>
   
    <input class="boton-login" type="submit" value="Registrar" >
    
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? inicia sesión</a>
    <a href="/recover_pass">Olvide Mi Contraseña</a>
</div>