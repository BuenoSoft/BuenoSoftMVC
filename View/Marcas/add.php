    <form method="post" name="frmadd_mar" action="index.php?c=marcas&a=add">
        <table>
            <tr>
                <td><label for="nom">Nombre de la Marca:</label></td>
                <td><input type="text" name="txtnom" id="nom" placeholder="Ingrese Nombre del Rol" required="required" autofocus /></td>
            </tr>
        </table>
        <p>
            <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
            <a href="index.php?c=marcas&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a>            
        </p>
    </form>