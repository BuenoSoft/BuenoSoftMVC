<h3>Crear Vehículo</h3>
<form method="post" action="index.php?c=vehiculos&a=add" name="frm_addveh" enctype="multipart/form-data">
    <table>
        <tr>
            <td><label for="mat">Matrícula del Vehículo: (*)</label></td>
            <td><input type="text" name="txtmat" id="mat" autofocus required="required" placeholder="Ingrese Matrícula" /></td>
        </tr>
        <tr>
            <td><label for="precio">Precio del Vehículo: (*)</label></td>
            <td><input type="text" name="txtprecio" id="precio" required="required" placeholder="Ingrese Precio" /></td>
        </tr>
        <tr>
            <td><label for="cant">Cantidad del Vehículo: (*)</label></td>
            <td><input type="text" name="txtcant" id="cant" required="required" placeholder="Ingrese Cantidad" /></td>
        </tr>
        <tr>
            <td><label for="descrip">Descripción del Vehículo:</label></td>
            <td><textarea id="descrip" name="txtdes" rows="10" cols="40"></textarea></td>
        </tr>
        <tr>
            <td><label for="foto">Foto del Vehículo:</label></td>
            <td><input type="file" name="foto" id="foto" required="required" /></td>
        </tr>
        <tr>
            <td><label for="mod">Modelo del Vehículo: (*)</label></td>
            <td>
                <input id="mod" list="modelos" required="required" name="txtmod" />
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
                <input id="tipo" list="tipos" required="required" name="txt_tipo" />
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
