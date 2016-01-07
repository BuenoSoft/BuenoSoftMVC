    <h3>Autenticar Usuario</h3>
    <form method="post" action="index.php?c=usuarios&a=login">
        <table>
            <tr>
                <td><label for="user">Usuario: </label></td>
                <td><input type="text" name="user" id="user" placeholder="Ingrese su Nick" required="required" autofocus /></td>
            </tr>          
            <tr>
                <td><label for="pass">Contraseña: </label></td>
                <td><input type="password" name="pass" id="pass" placeholder="Ingrese su Clave" required="required" /></td>
            </tr>          
        </table>
        <p>
            <input type="submit" name="login" value="Entrar" />
        </p>       
    </form>