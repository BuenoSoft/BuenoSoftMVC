<h3>Editar Vehículo</h3>
<form method="post" action="index.php?c=vehiculos&a=edit&p=<?php echo \App\Session::get('id'); ?>" name="frm_editveh">
    <table>
        <tr>
            <td><label for="id">Número del Vehículo:</label></td>
            <td><input type="hidden" name="hid" value="<?php echo $vehiculo->getId(); ?>" /><?php echo $vehiculo->getId(); ?></td>
        </tr>
        <tr>
            <td><label for="mat">Matrícula del Vehículo:</label></td>
            <td><input type="text" name="txtmat" id="mat" autofocus required="required" placeholder="Ingrese Matrícula" value="<?php echo $vehiculo->getMat(); ?>" /></td>
        </tr>
        <tr>
            <td><label for="precio">Precio del Vehículo:</label></td>
            <td><input type="text" name="txtprecio" id="precio" required="required" placeholder="Ingrese Precio" value="<?php echo $vehiculo->getPrecio(); ?>" /></td>
        </tr>
        <tr>
            <td><label for="cant">Cantidad del Vehículo:</label></td>
            <td><input type="text" name="txtcant" id="cant" required="required" placeholder="Ingrese Cantidad" value="<?php echo $vehiculo->getCant(); ?>" /></td>
        </tr>
        <tr>
            <td><label for="descrip">Descripción del Vehículo:</label></td>
            <td><textarea id="descrip" name="txtdes" rows="10" cols="40"><?php echo $vehiculo->getDescrip(); ?></textarea></td>
        </tr>
        <tr>
            <td><label for="foto">Foto del Vehículo:</label></td>
            <td>
                <img src="<?php echo $vehiculo->getFoto(); ?>" width='174' height='100'>&nbsp;
                <a href="index.php?c=vehiculos&a=foto">[Cambiar]</a>
            </td>
        </tr>
        <tr>
            <td>Modelo del Vehículo:</td>
            <td>
                <input id="mod" list="modelos" required="required" name="txtmod" value="<?php echo $vehiculo->getModelo()->getId(); ?>" />
                <datalist id="modelos">
                    <?php foreach ($modelos as $modelo) { ?>
                        <option value=<?php echo $modelo->getId();?> ><?php echo $modelo->getMarca()->getNombre()." ".$modelo->getNombre();?> </option>
                    <?php }?>
                </datalist> &nbsp;
                <input type="button" onclick="frm_addveh.submit();" value="Buscar" />
            </td>
        </tr>
        <tr>
            <td><label for="tipo">Tipo del Vehículo:</label></td>
            <td>
                <input id="mod" list="tipos" required="required" name="txt_tipo" value="<?php echo $vehiculo->getTipo()->getId(); ?>" />
                <datalist id="tipos">
                    <?php foreach ($tiposveh as $tipoveh) { ?>
                        <option value="<?php echo $tipoveh->getId(); ?>"><?php echo $tipoveh->getNombre(); ?></option>
                    <?php }?>    
                </datalist>
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=vehiculos&a=index"><input type="button" value="Cancelar" /></a>
    </p>
</form>