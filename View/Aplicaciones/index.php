<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Aplicaciones</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>
        <a href="index.php?c=aplicaciones&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>    
    <?php } ?>    
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmsearch" method="post" action="index.php?c=aplicaciones&a=index"> 
                <table style="width: 99%;">
                    <tr>
                        <td style="width: 50%;">
                            <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>
                                <input name="aeronave" id="aeronave" /> 
                            <?php } ?>
                        </td>
                        <td style="width: 50%;"> 
                            <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Piloto" and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>                    
                                <input name="piloto" id="piloto" /> 
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;">
                            <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>        
                                <input name="tipo" id="tipo" />                                 
                            <?php } ?>
                        </td>
                        <td style="width: 50%;">
                            <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>    
                                <input name="cliente" id="cliente" />                         
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <br />
                <p>
                    <b>Período Inicial:&nbsp;</b><input type="text" name="fec1" id="fecini" />&nbsp;
                    <b>Período Final:&nbsp;</b><input type="text" name="fec2" id="fecfin" />&nbsp;
                    <input type="button" onclick="frmsearch.submit();" name="btnsearch" value="Buscar" class="btn btn-theme01" tabindex="2" />&nbsp;
                    <a href="index.php?c=pdf&a=todos" target="_blank">
                        <input type="button" value="Imprimir" class="btn btn-theme01" tabindex="3" />
                        <!--<button class="btn btn-theme05" tabindex="3"><i class="fa fa-print"></i>&nbsp;Imprimir</button>-->
                    </a>
                </p>
            </form>       
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
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
                        <td>
                            <?php 
                                foreach($aplicacion->getUsados() as $usado) {
                                    if($usado->getUsuario()->getRol()->getNombre() == "Piloto"){ ?>
                                        <a href="index.php?c=usuarios&a=view&d=<?php echo $usado->getUsuario()->getId(); ?>">
                                            <?php echo $usado->getUsuario()->getDatoUsu()->getNombre(); ?>
                                        </a>                                        
                            <?php
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                foreach($aplicacion->getUsados() as $usado) {
                                    if($usado->getVehiculo()->getTipo()->getNombre() == "Aeronave"){ ?>
                                        <a href="index.php?c=vehiculos&a=view&d=<?php echo $usado->getVehiculo()->getId(); ?>">
                                            <?php echo $usado->getVehiculo()->getMatricula(); ?>
                                        </a>                                        
                            <?php
                                    }
                                }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?c=usuarios&a=view&d=<?php echo $aplicacion->getCliente()->getId(); ?>">
                                <?php echo $aplicacion->getCliente()->getNombre(); ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?c=pistas&a=view&d=<?php echo $aplicacion->getPista()->getId(); ?>">
                                <?php echo $aplicacion->getPista()->getNombre(); ?>
                            </a>
                        </td>
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
                            <?php if(\App\Session::get('log_in') != null and App\Session::get('log_in')->getRol()->getNombre() != "Cliente") { ?>
                                <a href="index.php?c=aplicaciones&a=edit&d=<?php echo $aplicacion->getId(); ?>" title="Editar">
                                    <i class="fa fa-edit" style="font-size: 22px;"></i>
                                </a>&nbsp;
                                 <a href="index.php?c=aplicaciones&a=delete&d=<?php echo $aplicacion->getId(); ?>" title="Borrar" onclick="return confirm('¿Desea borrar la aplicación seleccionada?');" >
                                    <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                                </a>&nbsp;
                                <a href="index.php?c=usados&a=index&d=<?php echo $aplicacion->getId(); ?>" title="Usados">
                                    <i class="fa fa-car" style="font-size: 22px;"></i>
                                </a>&nbsp;
                            <?php } ?>
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
<script>
    $(function(){
        $('#aeronave').magicSuggest({
            style: 'margin-bottom: 5px; margin-top: 5px; margin-left:5px',
            placeholder: 'Seleccione Aeronave',            
            maxSelection: 1,
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                    if($vehiculo->getTipo()->getNombre() == "Aeronave"){ ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php } } ?>
            ]
        });
        $('#piloto').magicSuggest({
            style: 'margin-left:10px',
            placeholder: 'Seleccione Piloto', 
            maxSelection: 1,
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Piloto") { ?>
                     '<?php echo $usuario->getDatoUsu()->getNombre(); ?>',
                <?php } }?>
            ]
        });
        $('#tipo').magicSuggest({
            style: 'margin-left:5px',
            placeholder: 'Seleccione un Tipo de Producto',
            maxSelection: 1,
            data: [
                <?php foreach($tipos as $tipo){ ?>
                     '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
        $('#cliente').magicSuggest({
            style: 'margin-left:10px',
            placeholder: 'Seleccione Cliente',
            maxSelection: 1,
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Cliente") { ?>
                     '<?php echo $usuario->getDatoUsu()->getNombre(); ?>',
                <?php } } ?>
            ]
        });
        $('#fecini').combodate({
            value: '',
            format: 'YYYY-MM-DD',
            template: 'YYYY-MM-DD'
        });
        $('#fecfin').combodate({
            value: '',
            format: 'YYYY-MM-DD',
            template: 'YYYY-MM-DD'
        }); 
    });
</script>