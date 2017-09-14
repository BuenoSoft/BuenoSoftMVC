<h3><i class="fa fa-angle-right"></i>&nbsp;Editar Aplicación número&nbsp;<?php echo \App\Session::get('app'); ?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=edit&d=<?php echo \App\Session::get('app'); ?>" name="frmedit" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="aeronave" name="aeronave" tabindex="1" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="cliente" name="cliente" tabindex="3" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" class="form-control"  maxlength="30" placeholder="Ej: Arroz" tabindex="5" value="<?php echo \App\Session::get("pass")[14]; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" onkeypress="return validarTextoyNum(event);"  class="form-control" placeholder="Ej: Fungicida" tabindex="6" value="<?php echo \App\Session::get("pass")[8]; ?>"><?php echo $aplicacion->getTratamiento(); ?></textarea> <!-- pattern no permitid -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada</label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" onkeypress="return validarNumeroP(event)" pattern="[\d\.]*" class="form-control"  placeholder="" tabindex="7" value="<?php echo \App\Session::get("pass")[4]; ?>" /> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control"  placeholder="" tabindex="8" value="<?php echo \App\Session::get("pass")[15]; ?>"/>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="tipo" name="tipo"  tabindex="9" />                         
                    </div>
                </div>
                <div class="form-group">
                    <table style="width:100%;">
                        <tr>
                            <td>    
                                <div class="col-sm-12" id="magic" style="text-align: center; margin-top: 15px; margin-bottom: 10px;">
                                </div>
                            </td>
                            <td>
                                <div class="col-sm-12" style="text-align: center; margin-top: 15px; margin-bottom: 10px;" id="contenedor">                                    
                                    <div class="added">
                                    </div>
                                </div>                                                
                            </td>
                            <td>
                                <div class="col-sm-12 ajustebtn" style="text-align: center; margin-top: 15px; margin-bottom: 10px;">
                                    <p>
                                        <a id="agregarCampo" class="btn btn-info" href="#"><i class="fa fa-plus"></i></a>
                                    </p>                                    
                                    <p>
                                        <a id="restarCampo" class="btn btn-info" href="#"><i class="fa fa-minus"></i></a>
                                    </p>                                    
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*"  class="form-control"  placeholder="" tabindex="11" value="<?php echo \App\Session::get("pass")[9]; ?>"/>
                    </div>
                </div>
            </div>
            
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="chofer"  name="chofer" tabindex="12" />
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="terrestre"  name="terrestre" tabindex="13" />
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
                            <input id="piloto"  name="piloto" tabindex="14" />
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
                        <input id="pista"  name="pista" tabindex="17" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d\/]*" class="form-control"  placeholder="" tabindex="19" value="<?php echo \App\Session::get("pass")[5]; ?>"/>
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
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Imagen</label>
                    <div class="col-sm-10">
                        <?php if(\App\Session::get("pass")[21] == null) { ?>
                            <img src="Public/img/manejo/profile_img.png" width='175' height='125' />&nbsp;&nbsp;
                        <?php } else { ?>
                            <img src="<?php echo \App\Session::get("pass")[21]; ?>" width='175' height='125' />&nbsp;&nbsp;
                        <?php } ?>
                            <a href="index.php?c=aplicaciones&a=avatar" title="Cambiar"><button type="button" name="btnavatar" value="Avatar" class="btn btn-theme00" tabindex="10" ><i class="fa fa-photo"></i>&nbsp;Cambiar</button></a>
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
    $(document).ready(function() {
        var MaxInputs = 8; //Número Maximo de Campos
        var contenedor = $("#contenedor"); //ID del contenedor
        var magic = $("#magic"); //ID del contenedor
        var AddButton = $("#agregarCampo"); //ID del Botón Agregar
        var DelButton = $("#restarCampo"); //ID del Botón Agregar
        //var x = número de campos existentes en el contenedor                
        var x = $("#contenedor div").length;        
        var FieldCount = x-2; //para el seguimiento de los campos
        var y = 0;
        <?php           
            if(count($aplicacion->getTiene()) > 0) {
                foreach($aplicacion->getTiene() as $tiene){
        ?>       
                    FieldCount++; 
                    $(magic).append('<div><p><input id="producto_'+ FieldCount +'" name="producto[]" /></p></div>');
                        $("#producto_"+ FieldCount).magicSuggest({
                        placeholder: 'Seleccione Producto',
                        value: ['<?php echo $tiene->getProducto()->getNombre(); ?>'],
                        maxSelection: 1,
                        maxDropHeight: 150,
                        sortDir: 'asc',
                        data: [
                            <?php foreach($productos as $producto){ ?>
                                '<?php echo $producto->getNombre(); ?>',
                            <?php } ?>
                        ]                
                    });
                    $(contenedor).append('<div><p><input type="text" name="dosis[]" id="campo_'+ FieldCount +'" onkeypress="return validarTextoyNum(event);" class="form-control" placeholder="Dosis '+ FieldCount +'"  /></p></div>');                
                    $("#campo_"+ FieldCount).val("<?php echo $tiene->getDosis(); ?>");
                    x++; //text box increment                
                    y= FieldCount;
        <?php            
                } 
            }  
        ?>
        $(AddButton).click(function (e) {
            if(x <= MaxInputs) //max input box allowed
            {
                FieldCount++;
                //agregar campo
                $(magic).append('<div><p><input id="producto_'+ FieldCount +'" name="producto[]" /></p></div>');
                $("#producto_"+ FieldCount).magicSuggest({
                    placeholder: 'Seleccione Producto',
                    maxSelection: 1,
                    maxDropHeight: 150,
                    sortDir: 'asc',
                    data: [
                        <?php foreach($productos as $producto){ ?>
                            '<?php echo $producto->getNombre(); ?>',
                        <?php } ?>
                    ]                
                });                
                $(contenedor).append('<div><p><input type="text" name="dosis[]" id="campo_'+ FieldCount +'" onkeypress="return validarTextoyNum(event);" class="form-control" placeholder="Dosis '+ FieldCount +'"/></p></div>');
                
                x++; //text box increment
                
                y=FieldCount;
            }
            return false;
        });
        $(DelButton).click(function (e) {
            if(x != 1) //max input box allowed
            {
                FieldCount--;               
                $("#campo_"+ y).remove(); //eliminar el campo
                $("#producto_"+ y).remove(); 
                y--;
                x--;
            }
            return false;
        });
    });
    $(function() {
    
        $.mask.definitions['~'] = "[+-]";
        $("#sur").mask("99 99 99",{ 
            placeholder: "xx xx xx",
            autoclear: false }).val('<?php echo (\App\Session::get("pass")[1] != null) ? \App\Session::get("pass")[1] : " "; ?>');     
        $("#oeste").mask("999 99 99",{ 
            placeholder: "xxx xx xx",
            autoclear: false }).val('<?php echo (\App\Session::get("pass")[2] != null) ? \App\Session::get("pass")[2] : " "; ?>');        
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
            <?php if(\App\Session::get("pass")[19] != null){?>
                value: ['<?php echo \App\Session::get("pass")[19]; ?>'],
            <?php } else { ?>
                value: [],
            <?php }?>
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
            <?php if(\App\Session::get("pass")[16] != null){  ?>
                value: ['<?php echo \App\Session::get("pass")[16]; ?>'],
            <?php } else { ?>
                value: [],
            <?php } ?>
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
            <?php if(\App\Session::get("pass")[10] != null){ ?>
                value: ['<?php echo \App\Session::get("pass")[10]; ?>'],
            <?php } else {?>
                value: [],
            <?php }?>            
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach($tipos as $tipo){ ?>
                        '<?php echo $tipo->getNombre(); ?>',
                <?php } ?>
            ]
        });
        
        $('#chofer').magicSuggest({
            placeholder: 'Seleccione Chofer',
            <?php if(\App\Session::get("pass")[18] != null){?>
                value: ['<?php echo \App\Session::get("pass")[18]; ?>'],
            <?php } else {?>
                value: [],
            <?php }?> 
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
            <?php if(\App\Session::get("pass")[20] != null){ ?>
                value: ['<?php echo \App\Session::get("pass")[20]; ?>'],
            <?php } else {?>
                value: [],
            <?php } ?>
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
            <?php if(\App\Session::get("pass")[17] != null){ ?>
                value: ['<?php echo \App\Session::get("pass")[17]; ?>'],
            <?php } else { ?>
                value : [],
            <?php }?> 
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
            <?php if(\App\Session::get("pass")[3] != null){ ?>
                value: ['<?php echo \App\Session::get("pass")[3]; ?>'],
            <?php } else { ?>
                value: [],
            <?php }?> 
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