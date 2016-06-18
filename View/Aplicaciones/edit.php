<h3><i class="fa fa-angle-right"></i>Editar Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>" name="frmedit">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="aeronaves" class="form-control_datalist" placeholder="Seleccione Aeronave" required="required" name="aeronave" tabindex="1" value="<?php echo \App\Session::get("pass")[19]; ?>" />
                        <datalist id="aeronaves">
                            <?php 
                                foreach ($aeronaves as $aeronave) { 
                                    if($aeronave->getEstado() == "H" and $aeronave->getTipo()->getNombre() == "Aeronave"){
                                        if($aeronave->checkUsu(\App\Session::get('app'))) { ?>
                                            <option value="<?php echo $aeronave->getId(); ?>"><?php echo $aeronave->getMatricula(); ?></option>
                            <?php        }else if(!$aeronave->checkFin()){ ?>
                                            <option value="<?php echo $aeronave->getId(); ?>"><?php echo $aeronave->getMatricula(); ?></option>
                            <?php       }                            
                                    }                            
                                }
                            ?>                            
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="2" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="clientes" class="form-control_datalist" placeholder="Seleccione Usuario" required="required" name="cliente" tabindex="3" value="<?php echo \App\Session::get("pass")[16]; ?>"/>
                        <datalist id="clientes">
                            <?php
                                foreach ($clientes as $cliente){
                                    if($cliente->getEstado() == "H" and $cliente->getRol()->getNombre() == "Cliente") { ?>
                                        <option value="<?php echo $cliente->getId() ?>"><?php echo $cliente->getDatoUsu()->getNombre(); ?></option>
                                <?php                                         
                                    }
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="4" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" class="form-control" required="required" maxlength="30" placeholder="Ej: Arroz" tabindex="5" value="<?php echo \App\Session::get("pass")[13]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" onkeypress="return validarTextoyNumPC(event);" required="required" class="form-control" placeholder="Ej: Fungicida" tabindex="6"><?php echo \App\Session::get("pass")[7]; ?></textarea> <!-- pattern no permitid -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" class="form-control" required="required" placeholder="" tabindex="7" value="<?php echo \App\Session::get("pass")[3]; ?>" /> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" class="form-control" required="required" placeholder="" tabindex="8" value="<?php echo \App\Session::get("pass")[14]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipos" class="form-control_datalist" placeholder="Seleccione Tipo de Producto" required="required" name="tipo" tabindex="9" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                        <datalist id="tipos">
                            <?php foreach ($tipos as $tipo){
                                    if($tipo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $tipo->getId() ?>"><?php echo $tipo->getNombre();?></option>
                            <?php   } 
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="10" value="Buscar" class="btn btn-theme01" />
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
                        <input type="text" name="txtviento" onkeypress="return validarNumeroPC(event);" pattern="[\d\.\,\-]*"  class="form-control" required="required" placeholder="" tabindex="11" value="<?php echo \App\Session::get("pass")[8]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="choferes" class="form-control_datalist" placeholder="Seleccione Chofer" required="required" name="chofer" tabindex="12" autofocus="autofocus" value="<?php echo \App\Session::get("pass")[18]; ?>"/>
                        <datalist id="choferes">
                            <?php
                                foreach ($choferes as $chofer){
                                    if($chofer->getEstado() == "H" and $chofer->getRol()->getNombre() == "Chofer") { 
                                        if($chofer->checkTra(\App\Session::get('app'))){ ?>
                                            <option value="<?php echo $chofer->getId() ?>"><?php echo $chofer->getDatoUsu()->getNombre();?></option>
                                <?php   } else if(!$chofer->checkFin()) { ?>
                                            <option value="<?php echo $chofer->getId(); ?>"><?php echo $chofer->getDatoUsu()->getNombre();?></option>
                                <?php       
                                        }                                        
                                    }
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="13" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="terrestres" class="form-control_datalist" placeholder="Seleccione Aeronave" required="required" name="terrestre" tabindex="14" value="<?php echo \App\Session::get("pass")[20]; ?>" />
                        <datalist id="terrestres">
                            <?php 
                                foreach ($terrestres as $terrestre) { 
                                    if($terrestre->getEstado() == "H" and ($terrestre->getTipo()->getNombre() == "Auto" or $terrestre->getTipo()->getNombre() == "Camión" or $terrestre->getTipo()->getNombre() == "Camioneta")){ 
                                        if($terrestre->checkUsu(\App\Session::get('app'))) { ?>
                                            <option value="<?php echo $terrestre->getId(); ?>"><?php echo $terrestre->getMatricula(); ?></option>
                            <?php       } else if(!$terrestre->checkFin()) { ?>
                                            <option value="<?php echo $terrestre->getId(); ?>"><?php echo $terrestre->getMatricula(); ?></option>
                            <?php       }                                     
                                    }                            
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="15" value="Buscar" class="btn btn-theme01" />    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Piloto&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="pilotos" class="form-control_datalist" placeholder="Seleccione Piloto" required="required" name="piloto" tabindex="16" autofocus="autofocus" value="<?php echo \App\Session::get("pass")[17]; ?>"/>
                        <datalist id="pilotos">
                            <?php
                                foreach ($pilotos as $piloto){
                                    if($piloto->getEstado() == "H" and $piloto->getRol()->getNombre() == "Piloto") { 
                                        if($piloto->checkTra(\App\Session::get('app'))) { ?>
                                           <option value="<?php echo $piloto->getId() ?>"><?php echo $piloto->getDatoUsu()->getNombre();?></option> 
                        <?php           } else if(!$piloto->checkFin()) { ?>
                                            <option value="<?php echo $piloto->getId() ?>"><?php echo $piloto->getDatoUsu()->getNombre();?></option>
                        <?php           }
                                    }
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="17" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="" tabindex="18" value="<?php echo \App\Session::get("pass")[12]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordcul" pattern="[+-]?[\d]{1,3}.{1}?[\d]{1,6},[+-]?[\d]{1,3}.{1}?[\d]{1,6}" onkeypress="return validarNumeroPC(event);" class="form-control" placeholder="-30.434,-57.439" tabindex="19" value="<?php echo \App\Session::get("pass")[1]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="pistas" class="form-control_datalist" placeholder="Seleccione Pista" required="required" name="pista" tabindex="20" value="<?php echo \App\Session::get("pass")[2]; ?>"/>
                        <datalist id="pistas">
                            <?php foreach ($pistas as $pista){ ?>
                                <option value="<?php echo $pista->getId() ?>"><?php echo $pista->getNombre(); ?></option>
                            <?php } ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="21" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarNumeroPC(event);" pattern="[\d\.\,\-]*" class="form-control" required="required" placeholder="" tabindex="22" value="<?php echo \App\Session::get("pass")[4]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" required="required" placeholder="" tabindex="23" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" tabindex="25" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechafin" class="form-control" tabindex="25" value="<?php echo \App\Session::get("pass")[6]; ?>" />
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroPC(event);" pattern="[\d\.\,\-]*" class="form-control" placeholder="" tabindex="26" value="<?php echo \App\Session::get("pass")[10]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroPC(event);" pattern="[\d\.\,\-]*" class="form-control" placeholder="" tabindex="27" value="<?php echo \App\Session::get("pass")[11]; ?>"/>
                    </div>
                </div> 
            </div>            
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="28"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="29"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>