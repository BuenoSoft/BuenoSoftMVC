<h3>Crear Compra</h3>
<form action="index.php?c=compras&a=add" method="post" name="frmadd_com">
    <table>
        <tr>
            <td><label for="tcom">Tipo de Compra:</label></td>
            <td>
                <input id="tcom" list="tipcompras" required="required" name="txttipcom" value="<?php echo \App\Session::get('tic'); ?>" />
                <datalist id="tipcompras">
                    <?php foreach ($tiposcom as $tipocom) { ?>
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
                    <?php foreach($clientes as $cliente) { ?>
                        <option value="<?php echo $cliente->getId(); ?>"><?php echo $cliente->getNick(); ?></option>
                    <?php } ?>
                </datalist> &nbsp;
                <input type="button" onclick="frmadd_com.submit();" value="Buscar" />
            </td>
        </tr>
        <tr>
            <td><label for="veh">Vehículo:</label></td>
            <td>
                <input id="veh" list="vehiculos" required="required" name="txtveh" value="<?php echo \App\Session::get('veh'); ?>" />
                <datalist id="vehiculos">
                    <?php foreach($vehiculos as $vehiculo) { ?>
                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMat(); ?></option> 
                    <?php } ?>
                </datalist> &nbsp;
                <input type="button" onclick="frmadd_com.submit();" value="Buscar" />
            </td>
        </tr>
        <tr>
            <td><label for="fecha">Fecha:</label></td>
            <td><input type="date" name="dtfecha" id="fecha" required="required"  /></td>
        </tr>
        <tr>
            <td><label for="cuotas">Cantidad de Cuotas:</label></td>
            <td><input type="number" name="txtcuotas" id="cuotas" required="required" min="1" max="36" /></td>
        </tr>
        <tr>
            <td><label for="cant">Cantidad para Comprar:</label></td>
            <td><input type="text" name="txtcant" id="cant" required="required" /></td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=compras&a=index"><input type="button" value="Cancelar" /></a>
    </p>
</form>