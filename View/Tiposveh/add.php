    <form method="post" name="frmadd_tv" action="index.php?c=tiposveh&a=add">
        <table>
            <tr>
                <td><label for="nom">Nombre del Tipo:</label></td>
                <td><input type="text" name="txtnom" id="nom" placeholder="Ingrese Nombre del Tipo" required="required" autofocus /></td>
            </tr>
        </table>
        <p>
            <input type="submit" value="Aceptar" name="btnaceptar" />&nbsp;
            <a href="index.php?c=tiposveh&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a>            
        </p>
    </form>