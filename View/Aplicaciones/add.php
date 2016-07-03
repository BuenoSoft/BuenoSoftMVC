<h3><i class="fa fa-angle-right"></i> Crear Aplicación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="aeronaves" id="aeronave" class="form-control" placeholder="Seleccione Aeronave" name="aeronave" required="required" tabindex="1" autofocus="autofocus" value="<?php echo \App\Session::get("pass")[19]; ?>" />
                        <datalist id="aeronaves">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H" and $vehiculo->getTipo()->getNombre() == "Aeronave" and !$vehiculo->checkFin()){ ?>
                                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                            <?php   }                            
                                }
                            ?>                            
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="clientes" id="cliente" class="form-control_datalist" placeholder="Seleccione Usuario"  name="cliente" required="required" tabindex="2" value="<?php echo \App\Session::get("pass")[16]; ?>"/>
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
                        <input type="button" onclick="frmadd.submit();" tabindex="3"value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event)" pattern="[A-Za-z\s]*" class="form-control"  maxlength="30" placeholder="Ej: Arroz" required="required" tabindex="4" value="<?php echo \App\Session::get("pass")[13]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat"  onkeypress="return validarTextoyNumPC(event);" class="form-control" placeholder="Ej: Fungicida" required="required" tabindex="5"><?php echo \App\Session::get("pass")[7]; ?></textarea>  <!-- pattern no permitido en textarea -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" class="form-control" placeholder="" required="required" tabindex="6" value="<?php echo \App\Session::get("pass")[3]; ?>" /> 
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" class="form-control" placeholder="" required="required" tabindex="7" value="<?php echo \App\Session::get("pass")[14]; ?>"/>
                    </div>
                </div>
            </div> 
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipos" id="tipo" class="form-control_datalist" placeholder="Seleccione Tipo de Producto"  name="tipo" required="required" tabindex="8" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                        <datalist id="tipos">
                            <?php foreach ($tipos as $tipo){
                                    if($tipo->getEstado() == "H"){ ?>
                                        <option value="<?php echo $tipo->getId() ?>"><?php echo $tipo->getNombre();?></option>
                            <?php   } 
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="9" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10">                        
                        <?php 
                            foreach ($productos as $producto) { 
                                if($producto->getEstado() == "H") { ?>
                                    <input type="checkbox" name="productos[]" value="<?php echo $producto->getId(); ?>" />&nbsp;<?php echo $producto->getNombre(); ?><br />
                        <?php                           
                                }                         
                            } ?>                                                    
                    </div>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" onkeypress="return validarTextoyNumPC(event);" pattern="[A-Za-z\s\d\.\,\/]*" class="form-control" placeholder="" required="required" tabindex="10" value="<?php echo \App\Session::get("pass")[8]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="choferes" id="chofer" class="form-control" placeholder="Seleccione Chofer" name="chofer" required="required" tabindex="11" value="<?php echo \App\Session::get("pass")[18]; ?>"/>
                        <datalist id="choferes">
                            <?php
                                foreach ($usuarios as $usuario){
                                    if($usuario->getEstado() == "H" and $usuario->getRol()->getNombre() == "Chofer" and !$usuario->checkFin()) { ?>
                                        <option value="<?php echo $usuario->getId() ?>"><?php echo $usuario->getDatoUsu()->getNombre();?></option>
                                <?php                                         
                                    }
                                }
                            ?>
                        </datalist>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="terrestres" id="terrestre" class="form-control" placeholder="Seleccione Terrestre"  name="terrestre" required="required" tabindex="12" value="<?php echo \App\Session::get("pass")[20]; ?>" />
                        <datalist id="terrestres">
                            <?php 
                                foreach ($vehiculos as $vehiculo) { 
                                    if($vehiculo->getEstado() == "H" and $vehiculo->getTipo()->getNombre() != "Aeronave" and !$vehiculo->checkFin()){ ?>
                                        <option value="<?php echo $vehiculo->getId(); ?>"><?php echo $vehiculo->getMatricula(); ?></option>
                            <?php   }                            
                                }
                            ?>
                        </datalist>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <?php if(\App\Session::get('log_in')!= null and (\App\Session::get('log_in')->getRol()->getNombre() == "Administrador" or \App\Session::get('log_in')->getRol()->getNombre() == "Administrador")){?>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Piloto&nbsp;<font color="red">*</font></label>
                        <div class="col-sm-10">
                            <input list="pilotos" id="piloto" class="form-control" placeholder="Seleccione Piloto"  name="piloto" required="required" tabindex="13" value="<?php echo \App\Session::get("pass")[17]; ?>"/>
                            <datalist id="pilotos">
                                <?php
                                    foreach ($usuarios as $usuario){
                                        if($usuario->getEstado() == "H" and $usuario->getRol()->getNombre() == "Piloto" and !$usuario->checkFin()) { ?>
                                            <option value="<?php echo $usuario->getId() ?>"><?php echo $usuario->getDatoUsu()->getNombre();?></option>
                                    <?php                                         
                                        }
                                    }
                                ?>
                            </datalist>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" maxlength="15" class="form-control"  placeholder="" required="required" tabindex="14" value="<?php echo \App\Session::get("pass")[12]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordcul" pattern="[+-]?[\d]{1,3}.{1}?[\d]{1,6},[+-]?[\d]{1,3}.{1}?[\d]{1,6}" onkeypress="return validarNumeroPC(event);" class="form-control" placeholder="-30.434,-57.439" tabindex="15" value="<?php echo \App\Session::get("pass")[1]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="pistas" id="pista" class="form-control_datalist" placeholder="Seleccione Pista"  required="required" name="pista" tabindex="16" value="<?php echo \App\Session::get("pass")[2]; ?>"/>
                        <datalist id="pistas">
                            <?php foreach ($pistas as $pista){ ?>
                                <option value="<?php echo $pista->getId() ?>"><?php echo $pista->getNombre(); ?></option>
                            <?php } ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" tabindex="17" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" class="form-control"  required="required" placeholder="" tabindex="18" value="<?php echo \App\Session::get("pass")[4]; ?>"/>
                    </div>
                </div>                               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" class="form-control" required="required" placeholder="" tabindex="19" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" tabindex="20" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechafin" class="form-control" tabindex="21" value="<?php echo \App\Session::get("pass")[6]; ?>" />
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroComa(event)" pattern="[\d\,]*" class="form-control" placeholder="" tabindex="22" value="<?php echo \App\Session::get("pass")[10]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroComa(event)" pattern="[\d\,]*" class="form-control" placeholder="" tabindex="23" value="<?php echo \App\Session::get("pass")[11]; ?>"/>
                    </div>
                </div> 
            </div>            
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="24"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="25"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>             
    </div>
</form>
<script>
    $(function() {
        $('form[name="frmadd"]').submit(function() {
            var tipo_v = $('#tipo').val();
            var tipo_s = $('#tipos option').filter(function() { return this.value === tipo_v; }).attr('value');
            var aeronave_v = $('#aeronave').val();
            var aeronave_s = $('#aeronaves option').filter(function() { return this.value === aeronave_v; }).attr('value');
            var piloto_v = $('#piloto').val();
            var piloto_s = $('#pilotos option').filter(function() { return this.value === piloto_v; }).attr('value');
            var terrestre_v = $('#terrestre').val();
            var terrestre_s = $('#terrestres option').filter(function() { return this.value === terrestre_v; }).attr('value');
            var chofer_v = $('#chofer').val();
            var chofer_s = $('#choferes option').filter(function() { return this.value === chofer_v; }).attr('value');
            var cliente_v = $('#cliente').val();
            var cliente_s = $('#clientes option').filter(function() { return this.value === cliente_v; }).attr('value');
            var pista_v = $('#pista').val();
            var pista_s = $('#pistas option').filter(function() { return this.value === pista_v; }).attr('value');
            if(!tipo_s){
                alert('Seleccione una de las opciones existentes para el tipo');
                return false;
            } else if(!aeronave_s){
                alert('Seleccione una de las opciones existentes para la aeronave');
                return false;
            } else if(!piloto_s){
                alert('Seleccione una de las opciones existentes para el piloto');
                return false;
            } else if(!terrestre_s){
                alert('Seleccione una de las opciones existentes para el terrestre');
                return false;
            } else if(!chofer_s){
                alert('Seleccione una de las opciones existentes para el chofer');
                return false;
            } else if(!cliente_s){
                alert('Seleccione una de las opciones existentes para el cliente');
                return false;
            } else if(!pista_s){
                alert('Seleccione una de las opciones existentes para la pista');
                return false;    
            } else {
                return true;
            }
        });
    });
</script>