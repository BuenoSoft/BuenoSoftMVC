<h3><i class="fa fa-angle-right"></i>Editar Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="clientes" class="form-control_datalist" placeholder="Seleccione Usuario" required="required" name="cliente" value="<?php echo $aplicacion->getCliente()->getId(); ?>" tabindex="1" />
                        <datalist id="clientes">
                            <?php
                                foreach ($usuarios as $usuario){
                                    if($usuario->getEstado() == "H" and $usuario->getTipo() == "Usuario") { ?>
                                        <option value="<?php echo $usuario->getDatoUsu()->getId() ?>"><?php echo "Documento: ".$usuario->getDatoUsu()->getDocumento()." Nombre: ".$usuario->getDatoUsu()->getNombre();?></option>
                                <?php                                         
                                    }
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event)" class="form-control" required="required" maxlength="30" placeholder="" value="<?php echo $aplicacion->getCultivo(); ?>" tabindex="17" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" required="required" placeholder="" class="form-control" tabindex="2"><?php echo $aplicacion->getTratamiento(); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getAreaapl(); ?>" tabindex="3"/> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getCaudal(); ?>" tabindex="18"/>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getPadron(); ?>" tabindex="9"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Latitud&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordlat" onkeypress="return validarNumeroPunto(event)"class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getCultivoLat(); ?>" tabindex="4" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Longitud&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordlong" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getCultivoLong(); ?>" tabindex="5"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getFaja(); ?>" tabindex="16" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getTaquiIni(); ?>" tabindex="6" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getTaquiFin(); ?>" tabindex="7"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getDosis(); ?>" tabindex="14" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" value="<?php echo $aplicacion->getViento(); ?>" tabindex="8" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10">                        
                    <?php 
                        foreach ($productos as $producto) { 
                            if($producto->getEstado() == "H") { 
                                if($aplicacion->checkPro($producto->getId())) {?> 
                                    <input type="checkbox" name="productos[]" value="<?php echo $producto->getId(); ?>" checked="checked" />&nbsp;<?php echo $producto->getNombre(); ?><br />
                            <?php           
                                } else { ?>
                                    <input type="checkbox" name="productos[]" value="<?php echo $producto->getId(); ?>" />&nbsp;<?php echo $producto->getNombre(); ?><br />
                    <?php       }                                        
                            }                         
                        } 
                    ?>                                                    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículos</label>
                    <div class="col-sm-10">
                    <?php 
                        foreach($vehiculos as $vehiculo){
                            if($vehiculo->getEstado() == "H"){ 
                                if($aplicacion->checkUsu($vehiculo->getId())){ ?>
                                    <input type="checkbox" name="vehiculos[]" value="<?php echo $vehiculo->getId() ?>" checked="checked" />
                                    &nbsp;<?php echo "Matrícula: ".$vehiculo->getMatricula()." Tipo: ".$vehiculo->getTipo(); ?><br />
                            <?php
                                } else { ?>
                                    <input type="checkbox" name="vehiculos[]" value="<?php echo $vehiculo->getId() ?>" />
                                    &nbsp;<?php echo "Matrícula: ".$vehiculo->getMatricula()." Tipo: ".$vehiculo->getTipo(); ?><br />
                    <?php       }
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">           
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" value="<?php echo ($aplicacion->getFechaIni() == null ) ? "" : $aplicacion->mostrarDateTimeIni(); ?>" tabindex="11" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                       <input type="datetime-local" name="dtfechafin" class="form-control" value="<?php echo ($aplicacion->getFechaFin() == null) ? "" : $aplicacion->mostrarDateTimeFin(); ?>" tabindex="12" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Aplicación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipo" class="form-control" placeholder="Seleccione Tipo" required="required" name="tipos" value="<?php echo $aplicacion->getTipo(); ?>" tabindex="13" />
                        <datalist id="tipo">
                            <option value="S">Sólido</option>
                            <option value="L">Líquido</option>
                        </datalist>
                    </div>
                </div>
            </div> 
        </div>             
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="19"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="20"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>