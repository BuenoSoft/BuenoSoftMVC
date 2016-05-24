<h3><i class="fa fa-angle-right"></i> Crear Usuario</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=add" name="frmadd" onsubmit="return validarCedula(this.txtci.value);">     
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Sujeto:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Sujeto (*)</label>
                    <div class="col-sm-10">
                        <input id="suj" list="sujetos" class="form-control" placeholder="Seleccione un Tipo de Sujeto" required="required" name="cboxtiposuj" />
                        <datalist id="sujetos">
                            <option value="Seleccione">Seleccione</option>
                            <option value="Empresa">Sujeto Tipo Empresa</option>
                            <option value="Persona">Sujeto Tipo Persona</option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Documento del Sujeto (*)</label>
                    <div class="col-sm-10">
                        <input type="text" id="txtci" name="txtci" class="form-control" autofocus required placeholder="Ej: 28554564 - C.I" onkeypress="return validarNumero(event)" maxlength="8" style="display: none;" />
                        <input type="text" id="txtruc" name="txtruc" class="form-control" autofocus required placeholder="Ej: 285514564788 - RUC" onkeypress="return validarNumero(event)" maxlength="12" style="display: none;" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Sujeto (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnomsuj" class="form-control" required placeholder="Ej: Luis Ottonello" onkeypress="return validarTexto(event)" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección del Sujeto (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdir" class="form-control" required placeholder="Ej: Dr. Soca 300" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono del Sujeto</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttelefono" class="form-control"  placeholder="Ej: 47358545" onkeypress="return validarNumero(event)" maxlength="8" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular del Sujeto</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcelular" class="form-control" placeholder="Ej: 099564565" onkeypress="return validarNumero(event)" maxlength="9" />
                    </div>
                </div>                              
            </div>
        </div>        
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Usuario: </h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario (*)</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtuser" class="form-control" required placeholder="Ej: pop32" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Contraseña (*)</label>
                    <div class="col-sm-10">
                        <input type="password" name="txtpass" class="form-control" required placeholder="Ej: penelope4512" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Usuario (*)</label>
                    <div class="col-sm-10">
                        <input list="tipos" class="form-control" placeholder="Seleccione un Tipo de Usuario" required="required" name="cboxtipo" />
                        <datalist id="tipos">
                            <option value="Administrador">Administrador del Sistema</option>
                            <option value="Supervisor">Supervisor de Seguridad del Sistema</option>
                            <option value="Usuario">Usuario logueado como cliente</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=usuarios&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">       
    $(function() {
        $("#suj").change(function(){
            if($("#suj").val()=="Seleccione"){
                $("#txtruc").hide();
                $("#txtci").hide();
            }
            if($("#suj").val()=="Persona"){
                $("#txtruc").hide();
                $("#txtci").show();
            }
            if($("#suj").val()=="Empresa"){
                $("#txtci").hide();
                $("#txtruc").show();
            }
        });
    });
</script>