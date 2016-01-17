<h3>Registrar Pago de la Compra nro <?php echo \App\Session::get('id') ?></h3>
<p>
    <strong>Pago Total:<?php echo " $".$compra->obtenerPagoTotal(); ?></strong>&nbsp;
    <strong>Pago Mínimo:<?php echo " $" .$compra->obtenerPagoMinimo(); ?></strong>&nbsp;
    <strong>Cuotas Restantes:<?php echo " " .$compra->obtenerCuotasRestantes(); ?></strong>
</p>
<form action="index.php?c=pagos&a=add&p=<?php echo \App\Session::get('id'); ?>" method="post" name="frmadd_pag">
    <table>
        <tr>
            <td><label for="pag">Número del Pago:</label></td>
            <td><input type="hidden" name="hpag" value="<?php echo $pago; ?>" /><?php echo $pago; ?></td> 
        </tr>
        <tr>
            <td><label for="fec">Fecha de Pago:</label> </td>
            <td><input type="hidden" name="hfec" value="<?php echo date("Y/m/d"); ?>" /><?php echo date("d/m/Y"); ?></td>
        </tr>
        <tr>
            <td><label for="monto">Monto del Pago:</label></td>
            <td><input type="text" name="txtmonto" id="monto" required="required" autofocus="autofocus" /></td>
        </tr>
        <tr>
            <td><label for="cuotas">Cuotas a Pagar:</label></td>
            <td><input type="text" name="txtcuotas" id="cuotas" required="required" /></td>
        </tr>
    </table>
    <p>
        <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
        <a href="index.php?c=pagos&a=index&p=<?php echo \App\Session::get('id') ?>"><input type="button" value="Cancelar" /></a>
    </p>
</form>