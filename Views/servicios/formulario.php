
<div class="campo">
    <label for="nombre">Nombre:</label>
    <input
        id="nombre"
        name="nombre"
        placeholder="Nombre Servicio"
        type="text" 
        value="<?php echo s($servicio->nombre); ?>"
    >
</div>

<div class="campo">
    <label for="precio">Precio:</label>
    <input
        id="precio"
        name="precio"
        placeholder="Precio Servicio"
        type="number" 
        value="<?php echo s($servicio->precio); ?>"
        max="1000"
    >
</div>

