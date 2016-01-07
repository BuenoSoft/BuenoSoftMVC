    <h3>Editar Usuario</h3>
    <form method="post" name="frmedit_user" action="index.php?c=usuarios&a=edit&p=<?php echo \App\Session::get('id'); ?>">
        <table>
            <tr>
                <td><label for="id">Número de Usuario:</label></td>
                <td><input type="hidden" name="hid" value="<?php echo $usuario->getId(); ?>" /><?php echo $usuario->getId(); ?></td>
            </tr>
            <tr>
                <td><label for="nick">Nombre de Usuario: (*)</label></td>
                <td><input type="text" name="txtnick" id="nick" placeholder="Ingrese Nombre de Usuario" required="required"  autofocus="" value="<?php echo $usuario->getNick(); ?>" /></td>
            </tr>
            <tr>
                <td><label for="pass">Contraseña: (*)</label></td>
                <td><input type="password" name="txtpass" id="pass" placeholder="Ingrese Contraseña" required="required"  value="<?php echo $usuario->getPass(); ?>"  /></td>
            </tr>
            <tr>
                <td><label for="correo">Correo Electrónico: (*)</label></td>
                <td><input type="email" name="txtcor" id="correo" placeholder="Ingrese su Correo" required="required" value="<?php echo $usuario->getCorreo(); ?>" /></td>
            </tr>
            <tr>
                <td><label for="nombre">Nombre del Usuario:</label></td>
                <td><input type="text" name="txtnom" id="nombre" placeholder="Ingrese Nombre de Usuario" value="<?php echo $usuario->getNombre(); ?>"/></td>
            </tr>
            <tr>
                <td><label for="ape">Apellido del Usuario:</label></td>
                <td><input type="text" name="txtape" id="ape" placeholder="Ingrese Apellido de Usuario" value="<?php echo $usuario->getApellido(); ?>"/></td>
            </tr>
            <tr>
                <td><label for="rol">Rol: (*)</label></td>
                <td>
                    <input id="rol" list="roles" required="required" name="txtrol" value="<?php echo $usuario->getRol()->getId(); ?>" />
                    <datalist id="roles">
                        <?php foreach ($roles as $rol){ ?> 
                            <option value="<?php echo $rol->getId();?>"><?php echo $rol->getNombre();?></option>
                        <?php }?>
                    </datalist>
                </td>
            </tr>
        </table>
        <p>
            <input type="submit" value="Aceptar" name="btnaceptar" />  &nbsp;
            <a href="index.php?c=usuarios&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a>
        </p>
    </form>