<h3>Editar Compra</h3>
<form action="index.php?c=compras&a=edit&p=<?php echo \App\Session::get('id'); ?>" method="post" name="frmedit_com">
    <table>
        <tr>
            <td><label for="id">Número de Compra:</label></td>
            <td><input type="hidden" name="hid" value="<?php echo $compra->getId(); ?>" /><?php echo $compra->getId(); ?></td>
        </tr>
        <tr>
            <td><label for="tcom">Tipo de Compra:</label></td>
            <td>
                <input id="tcom" list="tipcompras" required="required" name="txttipcom" value="<?php echo \App\Session::get('tic'); ?>" />
                <datalist id="tipcompras">
                    <?php foreach (Session::get('tiposcom') as $tipocom) { ?>
                        <option value="<?php echo $tipocom->getId(); ?>"><?php echo $tipocom->getNombre(); ?></option> 
                    <?php } ?>                   
                </datalist>
            </td>
        </tr>
        <tr>
            <td><label for="cli">Cliente:</label></td>
            <td>
                <input id="cli" list="clientes" required="required" name="txtcli" value="<?php echo \App\Session::get('cli'); ?>" />
                <datalist id="clientes">
                    <?php foreach(Session::get('clientes') as $cliente) { ?>
                        <option value="<?php echo $cliente->getId(); ?>"><?php echo $cliente->getNick(); ?></option>
                    <?php } ?>
                </datalist> &nbsp;
                <input type="button" onclick="frmedit_com.submit();" value="Buscar" />
            </td>
        </tr>
        <tr>
            <td><label for="veh">Vehículo:</label></td>
            <td>
                <input id="veh" list="vehiculos" required="required" name="txtveh" value="<?php echo \App\Session::get('veh'); ?>" />
                <datalist id="vehiculos">
                    <?php foreach(Session::get('vehiculos') as $vehiculo) { ?>
                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMat(); ?></option> 
                    <?php } ?>
                </datalist> &nbsp;
                <input type="button" onclick="frmedit_com.submit();" value="Buscar" />
            </td>
        </tr>
        <tr>
            <td><label for="fecha">Fecha:</label></td>
            <td><input type="date" name="dtfecha" id="fecha" required="required" value="<?php echo $compra->getFecha(); ?>"  /></td>
        </tr>
        <tr>
            <td><label for="cuotas">Cantidad de Cuotas:</label></td>
            <td><input type="number" name="txtcuotas" id="cuotas" required="required" min="1" max="36" value="<?php echo $compra->getCuotas(); ?>" /></td>
        </tr>
        <tr>
            <td><label for="cant">Cantidad para Comprar:</label></td>
            <td><input type="text" name="txtcant" id="cant" required="required" value="<?php echo $compra->getCant(); ?>" /></td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=compras&a=index"><input type="button" value="Cancelar" /></a>
    </p>
</form>