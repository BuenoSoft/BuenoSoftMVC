    <h3>Crear Usuario</h3>
    <form method="post" name="frmadd_user" action="index.php?c=usuarios&a=add">
        <table>
            <tr>
                <td><label for="nick">Nombre de Usuario: (*)</label></td>
                <td><input type="text" name="txtnick" id="nick" placeholder="Ingrese Nombre de Usuario" required="required" autofocus="" /></td>
            </tr>
            <tr>
                <td><label for="pass">Contraseña: (*)</label></td>
                <td><input type="password" name="txtpass" id="pass" placeholder="Ingrese Contraseña" required="required"  /></td>
            </tr>
            <tr>
                <td><label for="correo">Correo Electrónico: (*)</label></td>
                <td><input type="email" name="txtcor" id="correo" placeholder="Ingrese su Correo" required="required" /></td>
            </tr>
            <tr>
                <td><label for="nombre">Nombre del Usuario:</label></td>
                <td><input type="text" name="txtnom" id="nombre" placeholder="Ingrese Nombre de Usuario" /></td>
            </tr>
            <tr>
                <td><label for="ape">Apellido del Usuario:</label></td>
                <td><input type="text" name="txtape" id="ape" placeholder="Ingrese Apellido de Usuario" /></td>
            </tr>
            <?php if(\App\Session::get("log_in")!= null and \App\Session::get("log_in")->getRol()->getNombre() == "ADMIN"){ ?>
                <td><label for="rol">Rol: (*)</label></td>
                <td>
                    <input id="rol" list="roles" required="required" name="txtrol" />
                    <datalist id="roles">
                        <?php foreach ($roles as $rol){ ?> 
                            <option value="<?php echo $rol->getId();?>"><?php echo $rol->getNombre();?></option>
                        <?php }?>
                    </datalist>
                </td>
            <?php } else { ?>
                <input type="hidden" name="rol" value="2" />
            <?php } ?>
        </table>        
        <p>
           <input type="submit" value="Aceptar" name="btnaceptar" /> 
           <?php if(\App\Session::get("log_in")!= null and \App\Session::get("log_in")->getRol()->getNombre() == "ADMIN"){ ?>
                  &nbsp;<a href="index.php?c=usuarios&a=index"><input type="button" value="Cancelar" name="btncancelar" /></a> 
           <?php } ?>
        </p>
    </form>
