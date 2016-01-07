<form method="post" name="frmedit_tv" action="index.php?c=tiposveh&a=edit&p=<?php echo \App\Session::get('id'); ?>">
    <table>
        <tr>
            <td><label for="id">Número del Rol:</label></td>
            <td><input type="hidden" name="hid" value="<?php echo $tv->getId(); ?>" /><?php echo $tv->getId(); ?></td>
        </tr>
        <tr>
            <td><label for="nom">Nombre del Rol:</label></td>
            <td><input type="text" name="txtnom" id="nom" placeholder="Ingrese Nombre del Tipo" required="required" value="<?php echo $tv->getNombre(); ?>" autofocus="" /></td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=roles&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a>            
    </p>
</form>