    <form method="post" name="frmedit_tc" action="index.php?c=tiposcom&a=edit&p=<?php echo \App\Session::get('id'); ?>">
        <table>
            <tr>
                <td><label for="id">Número del Tipo:</label></td>
                <td><input type="hidden" name="hid" value="<?php echo $tipocom->getId(); ?>" /><?php echo $tipocom->getId(); ?></td>
            </tr>
            <tr>
                <td><label for="nom">Nombre del Tipo:</label></td>
                <td><input type="text" name="txtnom" id="nom" placeholder="Ingrese Nombre del Tipo" required="required" autofocus value="<?php echo $tipocom->getNombre(); ?>" /></td>
            </tr>
        </table>
        <p>
            <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
            <a href="index.php?c=tiposcom&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a>            
        </p>
    </form>