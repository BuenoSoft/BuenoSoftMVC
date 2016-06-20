<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Aplicaciones</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=aplicaciones&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=aplicaciones&a=index"> 
              <p>
                    <input list="aeronaves" name="aeronave" placeholder="Seleccione Aeronave" class="form-control_index" /> 
                    <datalist id="aeronaves">
                        <?php 
                            foreach ($vehiculos as $vehiculo) {
                                if($vehiculo->getEstado() == "H" and ($vehiculo->getTipo()->getNombre() == "Avion" or $vehiculo->getTipo()->getNombre() == "Aeronave")) {
                        ?>
                                    <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                        <?php   } 
                            }
                        ?>
                    </datalist>&nbsp;
                    <input list="pilotos" name="piloto" placeholder="Seleccione Piloto" class="form-control_index" /> 
                    <datalist id="pilotos">
                        <?php 
                            foreach ($usuarios as $usuario) {
                                if($usuario->getEstado() == "H" and $usuario->getRol()->getNombre() == "Piloto") {
                        ?>
                                    <option value="<?php echo $usuario->getId(); ?>"><?php echo $usuario->getDatoUsu()->getNombre(); ?></option>
                        <?php   } 
                            }
                        ?>
                    </datalist>&nbsp;
                    <input list="tipos" name="tipo" placeholder="Seleccione Tipo" class="form-control_index" /> 
                    <datalist id="tipos">
                        <?php 
                            foreach ($tipos as $tipo) {
                                if($tipo->getEstado() == "H") {
                        ?>
                                    <option value="<?php echo $tipo->getId(); ?>"><?php echo $tipo->getNombre(); ?></option>
                        <?php                         
                                }
                            }
                        ?>
                    </datalist>&nbsp;
                    <input list="clientes" name="usuario" placeholder="Seleccione Usuario" class="form-control_index" /> 
                    <datalist id="clientes">
                        <?php 
                            foreach ($usuarios as $usuario) {
                                if($usuario->getEstado() == "H" and $usuario->getRol()->getNombre() == "Cliente") {
                        ?>
                                    <option value="<?php echo $usuario->getId(); ?>"><?php echo $usuario->getDatoUsu()->getNombre(); ?></option>
                        <?php   } 
                            }
                        ?>
                    </datalist>
                </p>
                <p>
                    <input type="date" name="fec1" class="form-control_index" placeholder="Seleccione Fecha" />&nbsp;
                    <input type="date" name="fec2" class="form-control_index" placeholder="Seleccione Fecha" />&nbsp;
                    <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />&nbsp;
                    <a href="index.php?c=pdf&a=todos" target="_blank">
                        <input type="button" value="Imprimir" class="btn btn-theme01" tabindex="3" />
                    </a>
                </p>
            </form>       
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Aplicación</th>
                <th>Piloto</th>
                <th>Aeronave</th>                
                <th>Cliente</th>
                <th>Pista</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach ($aplicaciones as $aplicacion) { ?>
                    <tr>
                        <td><?php echo $aplicacion->getId(); ?></td>
                        <td>
                            <?php 
                                foreach($aplicacion->getUsados() as $usado) {
                                    if($usado->getUsuario()->getRol()->getNombre() == "Piloto"){
                                        echo $usado->getUsuario()->getDatoUsu()->getNombre();
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                foreach($aplicacion->getUsados() as $usado) {
                                    if($usado->getVehiculo()->getTipo()->getNombre() == "Aeronave"){
                                        echo $usado->getVehiculo()->getMatricula();
                                    }
                                }
                            ?>
                        </td>
                        <td><a href="index.php?c=usuarios&a=view&d=<?php echo $aplicacion->getCliente()->getId(); ?>" target="_blank"><?php echo $aplicacion->getCliente()->getNombre(); ?></a></td>
                        <td><a href="index.php?c=pistas&a=view&d=<?php echo $aplicacion->getPista()->getId(); ?>" target="_blank"><?php echo $aplicacion->getPista()->getNombre(); ?></a></td>
                        <td><?php echo $aplicacion->getTipo()->getNombre(); ?></td>
                        <td>
                            <?php  
                                if($aplicacion->getFechaFin() == null or $aplicacion->getFechaFin() == "0000-00-00 00:00:00"){
                                    if($aplicacion->getFechaIni() == "0000-00-00 00:00:00"){
                                        echo "En espera";
                                    }
                                    else {
                                        echo "Iniciado: ".$aplicacion->getFechaIni();
                                    }
                                }
                                else {
                                    echo "Finalizado: ".$aplicacion->getFechaFin();
                                }
                            ?>                        
                        </td>
                        <td>
                            <a href="index.php?c=aplicaciones&a=view&d=<?php echo $aplicacion->getId(); ?>" title="Ver">
                                <i class="fa fa-eye" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=aplicaciones&a=edit&d=<?php echo $aplicacion->getId(); ?>" title="Editar">
                                <i class="fa fa-edit" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=usados&a=index&d=<?php echo $aplicacion->getId(); ?>" title="Usados">
                                <i class="fa fa-car" style="font-size: 22px;"></i>
                            </a>&nbsp;
                        </td>                                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php if ($paginador != null) { ?> 
            <br />
            <?php if($paginador['primero']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['primero']; ?>" title="Primero">Primero</a>        
            <?php } ?>
            &nbsp;
            <?php if($paginador['anterior']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['anterior']; ?>" title="Anterior">Anterior</a>	
            <?php } ?>
            &nbsp;
            <?php if($paginador['siguiente']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['siguiente']; ?>" title="Siguiente">Siguiente</a>
            <?php } ?>
            &nbsp;
            <?php if($paginador['ultimo']) { ?>	
                <a href="<?php echo 'index.php?c=aplicaciones&a=index&p=' . $paginador['ultimo']; ?>" title="Último">Último</a>	
            <?php }     
        } ?>
    </section>
</div>