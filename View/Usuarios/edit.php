<h3><i class="fa fa-angle-right"></i> Editar Usuario</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=edit&p=<?php echo \App\Session::get('id'); ?>" name="frmedit">
<!-- <form class="form-horizontal style-form" action="http://www.google.com.uy"> -->
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos Personales:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Número</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <input type="hidden" name="hid" value="<?php echo $usuario->getId(); ?>" /><?php echo $usuario->getId(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <?php if($usuario->getDatoUsu()->getTipo() == "Persona") {?>
                            <p>
                                <input type="radio" name="rbtntipo" value="Persona" checked="checked" /><b>&nbsp;Persona</b>    <!-- Sin tabindex, ya que no llega al segundo option radio -->                        
                            </p>
                            <p>
                                <input type="radio" name="rbtntipo" value="Empresa" /><b>&nbsp;Empresa</b>  
                            </p>
                        <?php }else { ?>
                            <p>
                                <input type="radio" name="rbtntipo" value="Persona" /><b>&nbsp;Persona</b>    <!-- Sin tabindex, ya que no llega al segundo option radio -->                        
                            </p>
                            <p>
                                <input type="radio" name="rbtntipo" value="Empresa" checked="checked" /><b>&nbsp;Empresa</b>  
                            </p>
                        <?php }?>
                    </div>
                </div>                  
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" id="doc">Documento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" id="txtdoc" name="txtdoc" class="form-control" required="required" onkeypress="return validarNumero(event)" value="<?php echo $usuario->getDatoUsu()->getDocumento(); ?>" tabindex="1"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnom" class="form-control" required="required" placeholder="Ej: Luis Ottonello" onkeypress="return validarTexto(event)" value="<?php echo $usuario->getDatoUsu()->getNombre(); ?>" tabindex="2">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdir" class="form-control" required="required" placeholder="Ej: Dr. Soca 300" value="<?php echo $usuario->getDatoUsu()->getDireccion(); ?>" tabindex="3">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttelefono" class="form-control"  placeholder="Ej: 47358545" onkeypress="return validarNumero(event)" maxlength="8" value="<?php echo $usuario->getDatoUsu()->getTelefono(); ?>" tabindex="4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcelular" class="form-control" placeholder="Ej: 099564565" onkeypress="return validarNumero(event)" maxlength="9" value="<?php echo $usuario->getDatoUsu()->getCelular(); ?>" tabindex="5">
                    </div>
                </div>
                             
            </div>
        </div>        
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Usuario: </h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtuser" class="form-control" required placeholder="Ej: pop32" value="<?php echo $usuario->getNombre(); ?>" tabindex="7" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Contraseña&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="password" name="txtpass" class="form-control" required placeholder="Ej: penelope4512" value="<?php echo $usuario->getPass(); ?>" tabindex="8"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipos" class="form-control" placeholder="Seleccione un Tipo de Usuario" required="required" name="cboxtipo" value="<?php echo $usuario->getTipo(); ?>" tabindex="9" />
                        <datalist id="tipos">
                            <option value="Administrador">Administrador del Sistema</option>
                            <option value="Supervisor">Supervisor de Seguridad del Sistema</option>
                            <option value="Usuario">Usuario logueado como cliente</option>
                        </datalist>
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
                $("#doc").text("Cédula");
                $("#txtdoc").attr('maxlength','8');
                $("#txtdoc").attr('placeholder','Ej: 47068683 - CI');
            }
            else if($('input[name="rbtntipo"]:checked').val() == "Empresa"){
                $("#doc").text("RUC");
                $("#txtdoc").attr('maxlength','12');
                $("#txtdoc").attr('placeholder','Ej: 285514564788 - RUC');
            }
            $("#txtdoc").val("");
            $("#txtdoc").prop('readonly',false);
            $("#txtdoc").focus();                
        });
    }); 
</script>