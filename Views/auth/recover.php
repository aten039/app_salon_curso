<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nueva contraseña, a continuación</p>
<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method='POST'>

    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" name="password"  placeholder="Tu Contraseña" id="password">
    </div>

    <div class="campo">
        <label for="passwordVerify">Verificar Contraseña:</label>
        <input type="password" name="passwordVerify"  placeholder="Tu Contraseña" id="passwordVerify">
    </div>

    <input class="boton-login" type="submit" value="Actualizar" >
</form>

<div class="acciones">
    <a href="/crear_cuenta">¿Aún no tienes una cuenta? Crea Una</a>
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
</div>