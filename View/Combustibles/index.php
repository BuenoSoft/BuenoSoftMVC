<h3><i class="fa fa-angle-right"></i>&nbsp;Mantenimiento de Combustibles</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
    <a href="index.php?c=combustibles&a=add"><button class="btn btn-theme05" tabindex="4"><i class="fa fa-plus"></i>&nbsp;Crear</button></a>        
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <table class="table table-bordered table-striped table-condensed">
            <thead>                
                <th>Nombre</th>
                <th>Stock</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </thead>
            <tbody>
                <?php foreach($combustibles as $combustible){ ?>
                    <tr>
                        <td><?php echo $combustible->getNombre(); ?></td>
                        <td><?php echo $combustible->getStock(); ?></td>
                        <td><?php echo $combustible->getTipo()->getNombre(); ?></td>
                        <td>
                            <a href="index.php?c=combustibles&a=view&d=<?php echo $combustible->getId(); ?>" title="Ver">
                                <i class="fa fa-eye" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=combustibles&a=edit&d=<?php echo $combustible->getId(); ?>" title="Editar">
                                <i class="fa fa-edit" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=combustibles&a=delete&d=<?php echo $combustible->getId(); ?>" onclick="return confirm('¿Desea borrar el combustible seleccionado?');" title="Borrar">
                                <i class="fa fa-times-circle" style="font-size: 22px;"></i>
                            </a>&nbsp;
                            <a href="index.php?c=combustibles&a=add_mov&d=<?php echo $combustible->getId(); ?>" title="Movimientos">
                                <i class="fa fa-retweet" style="font-size: 22px;"></i>
                            </a>
                        </td>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>        
    </section>    
</div>
<br />
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
      	    <?php foreach($combustibles as $combustible) { ?>
                <div class="progress progress-striped active">                 
                    <?php 
                        $estilo = "progress-bar progress-bar-";
                        if($combustible->isDown()){
                            $estilo .= "danger";
                        } else if ($combustible->isExcellent()){
                            $estilo .= "success";
                        }
                         else if($combustible->isMedium()){
                            $estilo .= "warning";
                        } else {
                            $estilo .= "success";
                        }                     
                    ?>                        
                    <div class="<?php echo $estilo; ?>" role="progressbar" aria-valuenow="<?php echo $combustible->regla3(); ?>" aria-valuemin="0" aria-valuemax="<?php $combustible->getStockMax(); ?>" style="width:<?php echo $combustible->regla3()."%"; ?>;">
                        <b style="color: black;"><?php echo $combustible->getNombre()."&nbsp;".$combustible->getStock()."&nbsp;L"."&nbsp;&nbsp;&nbsp;".$combustible->regla3()."%"; ?></b>
                    </div>                    
                </div>                                                                                                                                                                                                                                                                 
            <?php              
                } 
            ?>                    
    </section>
</div>