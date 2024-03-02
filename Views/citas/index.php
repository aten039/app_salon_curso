<h1 class="nombre-pagina" >Gestion de citas</h1>
<p class="descripcion-pagina">Elige tu servicio para crear una nueva cita</p>

<?php include_once __DIR__ . '/../templates/barra.php'; ?>

<div id="app">

    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fechas de tu cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    disabled
                    id="nombre"
                    type="text"
                    placeholder="Tu nombre"
                    value="<?php echo s($nombre); ?>"
                />
            </div> 
            
            <div class="campo">
                <label for="fecha">fecha</label>
                <input
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d');?>"
                />
            </div>

            <div class="campo">
                <label for="hora">hora</label>
                <input
                    id="hora"
                    type="time"
                />
            </div>
            <input type="hidden" id="id" value="<?php echo $id ?>">

        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        
    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
            >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
            >Siguiente &raquo;</button>
    </div>

</div>

<?php

    $script='
        <script src="/build/js/app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    ';
?>
