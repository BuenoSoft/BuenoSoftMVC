<h3><i class="fa fa-angle-right"></i>&nbsp;Crear Aplicación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=add" name="frmadd" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="aeronave" name="aeronave" required="required" tabindex="1" autofocus="autofocus" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="cliente" name="cliente" required="required" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event)" pattern="[A-Za-z\s]*" class="form-control"  maxlength="30" placeholder="Ej: Arroz" required="required" tabindex="4" value="<?php echo \App\Session::get("pass")[14]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat"  onkeypress="return validarTextoyNum(event);" class="form-control" placeholder="Ej: Fungicida" required="required" tabindex="5"><?php echo \App\Session::get("pass")[8]; ?></textarea>  <!-- pattern no permitido en textarea -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" placeholder="" required="required" tabindex="6" value="<?php echo \App\Session::get("pass")[4]; ?>" /> 
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control" placeholder="" required="required" tabindex="7" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div> 
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="tipo" name="tipo" required="required" tabindex="8" />                                                                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10">
                        <input id="producto" name="producto" required="required" tabindex="10" />                                                  
                    </div>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control" placeholder="" required="required" tabindex="10" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="chofer" name="chofer" required="required" tabindex="11" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="terrestre" name="terrestre" required="required" tabindex="12" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <?php if(\App\Session::get('log_in')!= null and (\App\Session::get('log_in')->getRol()->getNombre() == "Administrador" or \App\Session::get('log_in')->getRol()->getNombre() == "Supervisor")){?>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Piloto&nbsp;<font color="red">*</font></label>
                        <div class="col-sm-10">
                            <input id="piloto" name="piloto" required="required" tabindex="13" />
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" maxlength="15" class="form-control"  placeholder="" tabindex="14" value="<?php echo \App\Session::get("pass")[13]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo</label>
                    <div class="col-sm-10">
                        <b>Sur</b>&nbsp<input name="txtsur" id="sur" type="text" placeholder="xx xx xx" class="form-control" tabindex="15" />
                        <br />
                        <b>Oeste</b>&nbsp<input name="txtoeste" id="oeste" type="text" placeholder="xxx xx xx" class="form-control" tabindex="16" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="pista" required="required" name="pista" tabindex="17" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control"  required="required" placeholder="" tabindex="18" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
                    </div>
                </div>                               
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" class="form-control" required="required" placeholder="" tabindex="19" value="<?php echo \App\Session::get("pass")[16]; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechaini" id="fecini" tabindex="20" value="<?php echo \App\Session::get("pass")[6]; ?>" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechafin" id="fecfin" tabindex="21" value="<?php echo \App\Session::get("pass")[7]; ?>" value="" />
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" placeholder="" tabindex="22" value="<?php echo \App\Session::get("pass")[11]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" placeholder="" tabindex="23" value="<?php echo \App\Session::get("pass")[12]; ?>"/>
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
        $.mask.definitions['~'] = "[+-]";
        $("#sur").mask("99 99 99",{ 
            placeholder: "xx xx xx",
            autoclear: false }).val('<?php echo \App\Session::get("pass")[1]; ?>');     
        $("#oeste").mask("999 99 99",{ 
            placeholder: "xxx xx xx",
            autoclear: false }).val('<?php echo \App\Session::get("pass")[2]; ?>'); 
        $('#fecini').combodate({
            value: null,
            format: 'DD-MM-YYYY-HH-mm',
            template: 'DD / MM / YYYY     HH : mm'           
        });
        $('#fecfin').combodate({
            value: null,
            format: 'DD-MM-YYYY-HH-mm',
            template: 'DD / MM / YYYY     HH : mm'       
        });
        $('#aeronave').magicSuggest({
            placeholder: 'Seleccione Aeronave',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                    if($vehiculo->getTipo()->getNombre() == "Aeronave"){ ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php } } ?>
            ]
        });
        $('#cliente').magicSuggest({
            placeholder: 'Seleccione Usuario',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Cliente") { ?>
                        '<?php echo $usuario->getNomReal(); ?>',
                <?php } } ?>
            ]
        });
        $('#tipo').magicSuggest({
            placeholder: 'Seleccione un Tipo de Producto',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach($tipos as $tipo){ ?>
                     '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
        $('#producto').magicSuggest({
            placeholder: 'Seleccione Productos',
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach($productos as $producto){ ?>
                     '<?php echo $producto->getNombre(); ?>',
                <?php } ?>
            ]
        });
        $('#chofer').magicSuggest({
            placeholder: 'Seleccione Chofer',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Chofer") { ?>
                     '<?php echo $usuario->getNomReal(); ?>',
                <?php } } ?>
            ]
        });
        $('#terrestre').magicSuggest({
            placeholder: 'Seleccione Terrestre',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                    if($vehiculo->getTipo()->getNombre() != "Aeronave"){ ?>
                     '<?php echo $vehiculo->getMatricula(); ?>',
                <?php }                
                    } ?>
            ]
        });
        $('#piloto').magicSuggest({
            placeholder: 'Seleccione Piloto',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($usuarios as $usuario){
                    if($usuario->getRol()->getNombre() == "Piloto" or $usuario->getRol()->getNombre() == "Administrador") { ?>
                     '<?php echo $usuario->getNomReal(); ?>',
                <?php } } ?>
            ]
        });
        $('#pista').magicSuggest({
            placeholder: 'Seleccione Pista',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($pistas as $pista){ ?>
                     '<?php echo $pista->getNombre(); ?>',
                <?php } ?>
            ]
        });
    });
</script>