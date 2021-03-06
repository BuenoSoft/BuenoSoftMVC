<h3><i class="fa fa-angle-right"></i>&nbsp;Crear Usuario</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=add" name="frmadd" onsubmit="return (document.getElementById('rbtntipo').value === 'Persona') ? validarCedula(this.txtdoc.value) : null;" enctype="multipart/form-data" autocomplete="off">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos Personales:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">                        
                        <p>
                            <input type="radio" name="rbtntipo" value="Persona" /><b>&nbsp;Persona</b>    <!-- Sin tabindex, ya que no llega al segundo option radio -->                        
                        </p>
                        <p>
                            <input type="radio" name="rbtntipo" value="Empresa" /><b>&nbsp;Empresa</b>  
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" id="doc">Documento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" id="txtdoc" name="txtdoc" class="form-control" required="required" onkeypress="return validarNumero(event);" pattern="[\d]*" tabindex="1" readonly="readonly" placeholder="Seleccione tipo de documento" />
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre Real&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnom" class="form-control" required="required" placeholder="Ej: Luis Ottonello" onkeypress="return validarTexto(event);" pattern="[A-Za-z\s]*" maxlength="30" tabindex="2" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdir" class="form-control" maxlength="30" onkeypress="return validarTextoyNum(event);" pattern="[A-Za-z\s\d]*" placeholder="Ej: Dr. Soca 300" tabindex="3" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttelefono" class="form-control"  placeholder="Ej: 47358545" onkeypress="return validarNumero(event);" pattern="[\d]*" maxlength="8" tabindex="4"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcelular" class="form-control" placeholder="Ej: 099564565" onkeypress="return validarNumero(event);" pattern="[\d]*" maxlength="9" tabindex="5" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos del Usuario:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtuser" class="form-control" required="required" placeholder="Ej: pop32" maxlength="20" tabindex="6" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Contraseña&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="password" name="txtpass" class="form-control" maxlength="32" required="required" placeholder="Ej: penelope4512" tabindex="7" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Rol&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input id="rol" required="required" name="rol" tabindex="8" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Avatar</label>
                    <div class="col-sm-10">
                        <input type="file" name="avatar" id="foto" tabindex="9" />
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="10"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=usuarios&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="11"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">       
    $(function() {
        $('input[name="rbtntipo"]').click(function() {
            if($('input[name="rbtntipo"]:checked').val() == "Persona"){
                $("#doc").text("Cédula *");
                $("#txtdoc").attr('maxlength','8');
                $("#txtdoc").attr('placeholder','Ej: 47068683 - CI');
            }
            else if($('input[name="rbtntipo"]:checked').val() == "Empresa"){
                $("#doc").text("RUC *");
                $("#txtdoc").attr('maxlength','12');
                $("#txtdoc").attr('placeholder','Ej: 285514564788 - RUC');
            }
            $("#txtdoc").val("");
            $("#txtdoc").prop('readonly',false);
            $("#txtdoc").focus();                
        });
        $('#rol').magicSuggest({
            placeholder: 'Seleccione un Rol',
            maxSelection: 1,
            maxDropHeight: 150,
            sortDir: 'asc',
            data: [
                <?php foreach($roles as $rol){ 
                    if(App\Session::get('log_in')->getRol()->getNombre() == "Administrador"){
                        if($rol->getNombre() != "Supervisor"){
                ?>
                            '<?php echo $rol->getNombre(); ?>',
                <?php 
                        }                         
                    } else { ?>
                        '<?php echo $rol->getNombre(); ?>',
                <?php                 
                    } }
                ?>
            ]
        });
    }); 
</script>