<div class="barra">
    <p>Hola: <span><?php echo $nombre ?? '' ?></span></p>

    <a  href="/logout">Cerrar Sesion</a>
</div>

<?php if(isset($_SESSION['admin'])){ ?>
        
    <div class="barra-admin">
        <a class="boton" href="/admin">Ver Citas</a>
        <a class="boton" href="/servicios">Ver Servicios</a>
        <a class="boton" href="/servicios/crear">Nuevos Servicios</a>
    </div>

<?php } ?>