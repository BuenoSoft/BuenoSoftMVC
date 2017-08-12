<h3><i class="fa fa-angle-right"></i>&nbsp;Período de Zafras</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<input type="text" name="anio" id="anio" />
                                                
<script>
    $('#anio').magicSuggest({
        placeholder: 'Seleccione Anio',
        maxSelection: 1,
        sortDir: 'asc',
        value: [
            <?php foreach($anios as $anio){ ?>
                '<?php echo $anio; ?>'    
            <?php }?>
        ]
    });
</script>