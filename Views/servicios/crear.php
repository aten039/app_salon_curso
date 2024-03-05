<h1 class="nombre-pagina">Crear</h1>
<p class="descripcion-pagina">Creación de Servicios</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
    include_once __DIR__ . '/../templates/barra.php';
?>

<form action="/servicios/crear" method="POST" class="formulario">

    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" value="Crear Servicio" class="boton">

</form>