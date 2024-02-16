<?php
    if($alertas){
        foreach($alertas as $key=>$values):
            foreach($values as $value):
       
?>
<div class="alerta">
    <p class="<?php echo s($key);?>"><?php echo s($value); ?></p>
</div>
<?php
            endforeach;
        endforeach;
    }
?>