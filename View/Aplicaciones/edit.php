<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="aeronave" required="required" name="aeronave" tabindex="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="cliente" required="required" name="cliente" tabindex="3" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" class="form-control" required="required" maxlength="30" placeholder="Ej: Arroz" tabindex="5" value="<?php echo \App\Session::get("pass")[14]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" onkeypress="return validarTextoyNum(event);" required="required" class="form-control" placeholder="Ej: Fungicida" tabindex="6"><?php echo \App\Session::get("pass")[8]; ?></textarea> <!-- pattern no permitid -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" required="required" placeholder="" tabindex="7" value="<?php echo \App\Session::get("pass")[4]; ?>" /> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control" required="required" placeholder="" tabindex="8" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 82%;">
                                    <input id="tipo" name="tipo" required="required" tabindex="9" />
                                </td>
                                <td style="width: 18%;">
                                    <input type="button" onclick="frmedit.submit();" tabindex="10" value="Buscar" class="btn btn-theme01" style="margin-left: 5px;" />
                                </td>
                            </tr>
                        </table> 
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
                        <input type="text" name="txtviento" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*"  class="form-control" required="required" placeholder="" tabindex="11" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                    </div>
                </div>
            </div>
            
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="chofer" required="required" name="chofer" tabindex="12" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="terrestre" required="required" name="terrestre" tabindex="13" />
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
                            <input id="piloto" required="required" name="piloto" tabindex="14" />
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" pattern="[A-Za-z\s\d]*" maxlength="15" placeholder="" tabindex="15" value="<?php echo \App\Session::get("pass")[13]; ?>" />
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
                        <input type="text" name="txtfaja" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control" required="required" placeholder="" tabindex="19" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" required="required" placeholder="" tabindex="20" value="<?php echo \App\Session::get("pass")[16]; ?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechaini" id="fecini" tabindex="21" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10">
                        <input type="text" name="dtfechafin" id="fecfin" tabindex="22" />
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" placeholder="" tabindex="23" value="<?php echo \App\Session::get("pass")[11]; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control" placeholder="" tabindex="24" value="<?php echo \App\Session::get("pass")[12]; ?>"/>
                    </div>
                </div> 
            </div>            
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="25"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="26"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
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
            value: '<?php echo \App\Session::get("pass")[6]; ?>',
            format: 'DD-MM-YYYY-HH-mm',
            template: 'DD / MM / YYYY     HH : mm' 
        });
        $('#fecfin').combodate({
            value: '<?php echo \App\Session::get("pass")[7]; ?>',
            format: 'DD-MM-YYYY-HH-mm',
            template: 'DD / MM / YYYY     HH : mm' 
        });
        $('#aeronave').magicSuggest({
            placeholder: 'Seleccione Aeronave',
            value: ['<?php echo \App\Session::get("pass")[20]; ?>'],
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
            value: ['<?php echo \App\Session::get("pass")[17]; ?>'], 
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
            value: ['<?php echo \App\Session::get("pass")[10]; ?>'],            
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
            value:[
              <?php foreach ($productos as $producto) { 
                    if($producto->checkPro(\App\Session::get('app'))){ ?>  
                        '<?php echo $producto->getNombre(); ?>',
              <?php } }?>
            ],
            data: [
                <?php foreach($productos as $producto){ ?>
                     '<?php echo $producto->getNombre(); ?>',
                <?php } ?>
            ]
        });
        $('#chofer').magicSuggest({
            placeholder: 'Seleccione Chofer',
            value: ['<?php echo \App\Session::get("pass")[19]; ?>'], 
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
            value: ['<?php echo \App\Session::get("pass")[21]; ?>'],
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach ($vehiculos as $vehiculo) { 
                        if($vehiculo->getTipo()->getNombre() != "Aeronave"){ ?>
                                '<?php echo $vehiculo->getMatricula(); ?>',
                <?php } } ?>
            ]
        });
        $('#piloto').magicSuggest({
            placeholder: 'Seleccione Piloto',
            value: ['<?php echo \App\Session::get("pass")[18]; ?>'], 
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
            value: ['<?php echo \App\Session::get("pass")[3]; ?>'], 
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