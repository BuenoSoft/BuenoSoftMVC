<h3>Editar Foto del Vehículo</h3>
<form method="post" name="frm_imgveh" action="index.php?c=vehiculos&a=foto" enctype="multipart/form-data">
    <fieldset style="display: inline-block;">
        <legend>Seleccione su nueva imagen:</legend>
        <p align="center">
            <img src="<?php echo $vehiculo->getFoto(); ?>" width='400' height='300'>
            <br />
            <br />
            <input type="file" name="foto" id="foto" required="required" />
        </p>       
    </fieldset>
    <p>
        <input type="submit" name="btnaceptar" value="Aceptar" />&nbsp;
        <a href="index.php?c=vehiculos&a=edit&p=<?php echo \App\Session::get('id'); ?>"><input type="button" value="Cancelar" /></a>
    </p>
</form>
