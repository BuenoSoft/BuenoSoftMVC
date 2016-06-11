<h3><i class="fa fa-angle-right"></i>Editar Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Vehículos</label>
                    <div class="col-sm-10">
                        <?php 
                            foreach($vehiculos as $vehiculo){
                                if($vehiculo->getEstado() == "H") {
                                    if($vehiculo->checkUsu(\App\Session::get('app'))) { ?>
                                        <input type="checkbox" name="vehiculos[]" value="<?php echo $vehiculo->getId() ?>" checked="checked" />&nbsp;<?php echo "Matrícula: ".$vehiculo->getMatricula()." Tipo: ".$vehiculo->getTipo()->getNombre(); ?><br />
                        <?php     
                                    } else if(!$vehiculo->checkFin()){ ?>
                                        <input type="checkbox" name="vehiculos[]" value="<?php echo $vehiculo->getId() ?>" />&nbsp;<?php echo "Matrícula: ".$vehiculo->getMatricula()." Tipo: ".$vehiculo->getTipo()->getNombre(); ?><br />
                        <?php           
                                    }                                
                                } 
                            } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="clientes" class="form-control_datalist" placeholder="Seleccione Usuario" required="required" name="cliente" tabindex="1" autofocus="autofocus" value="<?php echo \App\Session::get("pass")[16]; ?>"/>
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
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event)" class="form-control" required="required" maxlength="30" placeholder="" tabindex="2" value="<?php echo \App\Session::get("pass")[13]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" required="required" class="form-control" placeholder="" tabindex="3"><?php echo \App\Session::get("pass")[7]; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" class="form-control" required="required" placeholder="" tabindex="4" value="<?php echo \App\Session::get("pass")[3]; ?>" /> 
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" class="form-control" required="required" placeholder="" tabindex="5" value="<?php echo \App\Session::get("pass")[14]; ?>"/>
                    </div>
                </div>
            </div> 
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipos" class="form-control_datalist" placeholder="Seleccione Tipo" required="required" name="tipo" tabindex="1" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                        <datalist id="tipos">
                            <?php foreach ($tipos as $tipo){ ?>
                                <option value="<?php echo $tipo->getId() ?>"><?php echo $tipo->getNombre();?></option>
                            <?php } ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10">                        
                        <?php 
                            foreach ($productos as $producto) { 
                                if($producto->getEstado() == "H") {
                                    if($producto->checkPro(\App\Session::get('app'))){ ?>
                                        <input type="checkbox" name="productos[]" value="<?php echo $producto->getId(); ?>" checked="checked"/>&nbsp;<?php echo $producto->getNombre(); ?><br />
                        <?php                                                           
                                    } else { ?>
                                        <input type="checkbox" name="productos[]" value="<?php echo $producto->getId(); ?>" />&nbsp;<?php echo $producto->getNombre(); ?><br />
                        <?php                
                                    }
                                }                         
                            } ?>                                                    
                    </div>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" tabindex="13" value="<?php echo \App\Session::get("pass")[8]; ?>"/>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="15"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="16"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Funcionarios</label>
                    <div class="col-sm-10">
                        <?php
                            foreach ($funcionarios as $funcionario){
                                if($funcionario->getEstado() == "H") {
                                    if($funcionario->checkTra(\App\Session::get('app'))){ ?>
                                        <input type="checkbox" name="funcionarios[]" value="<?php echo $funcionario->getId(); ?>" checked="checked" />&nbsp;<?php echo $funcionario->getDatoUsu()->getNombre(); ?><br />
                        <?php
                                    } else if(!$funcionario->checkFin()) { ?>
                                        <input type="checkbox" name="funcionarios[]" value="<?php echo $funcionario->getId(); ?>" />&nbsp;<?php echo $funcionario->getDatoUsu()->getNombre(); ?><br />
                        <?php                                        
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>                    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="" tabindex="6" value="<?php echo \App\Session::get("pass")[12]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordcul" onkeypress="return validarNumeroPC(event)" class="form-control" required="required" placeholder="-30.434,-57.439" tabindex="7" value="<?php echo \App\Session::get("pass")[1]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="pistas" class="form-control_datalist" placeholder="Seleccione Pista" required="required" name="pista" tabindex="1" value="<?php echo \App\Session::get("pass")[2]; ?>"/>
                        <datalist id="pistas">
                            <?php foreach ($pistas as $pista){ ?>
                                <option value="<?php echo $pista->getId() ?>"><?php echo $pista->getNombre(); ?></option>
                            <?php } ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarNumeroPunto(event)" class="form-control" required="required" placeholder="" tabindex="9" value="<?php echo \App\Session::get("pass")[4]; ?>"/>
                    </div>
                </div>                               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" required="required" placeholder="" tabindex="12" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" tabindex="14" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechafin" class="form-control" tabindex="15" value="<?php echo \App\Session::get("pass")[6]; ?>" />
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroPunto(event)" class="form-control" placeholder="" tabindex="10" value="<?php echo \App\Session::get("pass")[10]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroPunto(event)" class="form-control" placeholder="" tabindex="11" value="<?php echo \App\Session::get("pass")[11]; ?>"/>
                    </div>
                </div> 
            </div> 
        </div>             
    </div>
</form>