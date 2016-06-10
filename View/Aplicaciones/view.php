<h3><i class="fa fa-angle-right"></i>Ver Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo "Documento: ".$aplicacion->getCliente()->getDocumento()." Nombre: ".$aplicacion->getCliente()->getNombre();?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCultivo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTratamiento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada</label>                                           
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getAreaapl(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCaudal(); ?>
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <?php echo ($aplicacion->getFechaIni() == null ) ? "" : $aplicacion->mostrarDateTimeIni(); ?>
                    </div>
                </div>
                <div class="form-group" style="text-align: center;">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <?php echo ($aplicacion->getFechaFin() == null) ? "" : $aplicacion->mostrarDateTimeFin(); ?>
                    </div>
                </div>  
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getPadron(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCoordCul(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCoordPis(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getFaja(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiIni(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiFin(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getDosis(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getViento(); ?>
                    </div>
                </div>
            </div>
        </div>      
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="1"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</div>