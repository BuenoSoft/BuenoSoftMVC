<h3>Crear Modelo</h3>
<form method="post" action="index.php?c=modelos&a=add" name="frm_addmod">
    <table>
        <tr>
            <td><label for="nom">Nombre del Modelo:</label></td>
            <td><input type="text" id="nom" name="txtnom" required="required" autofocus /></td>
        </tr>
        <tr>
            <td><label for="mar">Marca del Modelo:</label></td>
            <td>                
                <input id="mar" list="marcas" required="required" name="txtmar" />
                <datalist id="marcas">
                    <?php foreach ($marcas as $marca) { ?>
                        <option value=<?php echo $marca->getId();?> ><?php echo $marca->getNombre();?> </option>
                    <?php }?>
                </datalist> &nbsp;
                <input type="button" onclick="frm_addmod.submit();" value="Buscar" />
            </td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=modelos&a=index"><input type="button" value="Cancelar" /></a>
    </p>
</form>