<h3>Editar Modelo</h3>
<form method="post" action="index.php?c=modelos&a=edit&p=<?php echo \App\Session::get('id'); ?>" name="frmedit_mod">
    <table>
        <tr>
            <td><label for="id">Número del Rol:</label></td>
            <td><input type="hidden" name="hid" value="<?php echo $modelo->getId(); ?>" /><?php echo $modelo->getId(); ?></td>
        </tr>
        <tr>
            <td><label for="nom">Nombre del Modelo:</label></td>
            <td><input type="text" id="nom" name="txtnom" required="required" autofocus value="<?php echo $modelo->getNombre();?>" /></td>
        </tr>
        <tr>
            <td><label for="mar">Marca del Modelo:</label></td>
            <td>                
                <input id="mar" list="marcas" required="required" name="txtmar" value="<?php echo $modelo->getMarca()->getId();?>" />
                <datalist id="marcas">
                    <?php foreach ($marcas as $marca) { ?>
                        <option value=<?php echo $marca->getId();?> ><?php echo $marca->getNombre();?> </option>
                    <?php }?>
                </datalist> &nbsp;
                <input type="button" onclick="frmedit_mod.submit();" value="Buscar" />
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=modelos&a=index"><input type="button" value="Cancelar" /></a>
    </p>
</form>