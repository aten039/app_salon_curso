
<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion</p>

<form class="formulario" method="POST" action="/">

    <div class="campo">
        <label class="label" for="email">Email:</label>
        <input  type="email" name="email" id="email" placeholder="Ingresa Tu Email">
    </div>
   
    <div class="campo">
        <label class="label" for="password">Contraseña:</label>
        <input  type="password" name="password" id="password" placeholder="Ingresa Tu Contraseña">
    </div>
    
    <input class="boton-login" type="submit" value="Iniciar Sesion" >
    
</form>

<div class="acciones">
    <a href="/crear_cuenta">¿Aún no tienes una cuenta? Crea Una</a>
    <a href="/recover_pass">Olvide Mi Contraseña</a>
</div>