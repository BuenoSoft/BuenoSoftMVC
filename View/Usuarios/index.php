<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Usuarios</h3>
<p>
    <a href="index.php?c=inicio&a=index" class=""><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;    
    <a href="index.php?c=usuarios&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=usuarios&a=index"> 
                <input type="search" name="txtbuscador" placeholder="Documento o Nombre Real" width="50" class="form-control_index" tabindex="1" autofocus="autofocus" />&nbsp;
                <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2"/>
            </form>        
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th>Nombre de Usuario</th>
                <th>Nombre Real</th>
                <th>Rol</th>
                <th>Opciones</th>                
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) {
                    if(App\Session::get('log_in')->getRol()->getNombre() == "Administrador"){
                        if($usuario->getRol()->getNombre() != "Supervisor"){
                ?>  
                            <tr>                        
                                <td><?php echo $usuario->getNombre(); ?></td>
                                <td><?php echo $usuario->getNomReal(); ?></td>
                                <td><?php echo $usuario->getRol()->getNombre(); ?></td>                        
                                <td>
                                    <a href="index.php?c=usuarios&a=view&d=<?php echo $usuario->getId(); ?>" title="Ver">
                                        <i class="fa fa-eye" style="font-size: 22px;"></i>
                                    </a>&nbsp;
                                    <a href="index.php?c=usuarios&a=edit&d=<?php echo $usuario->getId(); ?>" title="Editar">
                                        <i class="fa fa-edit" style="font-size: 22px;"></i>
                                    </a>&nbsp;
                                    <a href="index.php?c=usuarios&a=delete&d=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea borrar el usuario seleccionado?');" title="Borrar">
                                        <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                                    </a>
                                </td>
                            </tr>
                <?php   } 
                    } else {?>
                            <tr>                        
                                <td><?php echo $usuario->getNombre(); ?></td>
                                <td><?php echo $usuario->getNomReal(); ?></td>
                                <td><?php echo $usuario->getRol()->getNombre(); ?></td>                        
                                <td>
                                    <a href="index.php?c=usuarios&a=view&d=<?php echo $usuario->getId(); ?>" title="Ver">
                                        <i class="fa fa-eye" style="font-size: 22px;"></i>
                                    </a>&nbsp;
                                    <a href="index.php?c=usuarios&a=edit&d=<?php echo $usuario->getId(); ?>" title="Editar">
                                        <i class="fa fa-edit" style="font-size: 22px;"></i>
                                    </a>&nbsp;
                                    <a href="index.php?c=usuarios&a=delete&d=<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Desea borrar el usuario seleccionado?');" title="Borrar">
                                        <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                                    </a>
                                </td>
                            </tr>
                <?php }} ?>            
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
        <br />
        <?php if($paginador['primero']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
        <?php } ?>
        &nbsp;
        <?php if($paginador['anterior']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
        <?php } ?>
        &nbsp;
        <?php if($paginador['siguiente']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
        <?php } ?>
        &nbsp;
        <?php if($paginador['ultimo']) { ?>	
            <a href="<?php echo 'index.php?c=usuarios&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
        <?php }     
        } 
    ?>
    </section>
</div>