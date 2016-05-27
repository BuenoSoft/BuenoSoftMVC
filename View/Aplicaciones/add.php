<h3><i class="fa fa-angle-right"></i> Crear Aplicación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=add" name="frmadd" onsubmit='return validarCedula(this.txtdoc.value)'>
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cliente&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="clientes" class="form-control_datalist" placeholder="Seleccione Cliente" required="required" name="cliente" />
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
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" required="required" class="form-control" placeholder=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada&nbsp;<font color="red">*</font></label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" class="form-control" required="required" placeholder="" /> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Latitud&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="number" name="txtcoordlat" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Longitud&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="number" name="txtcoordlong" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="number" name="txttaquiIni" class="form-control" placeholder="" /> <!-- pattern="[0-9]+([,][0-9])" -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="number" name="txttaquiFin" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="number" name="txtviento" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Importe</label>
                    <div class="col-sm-10">
                        <input type="number" name="txtimporte" class="form-control" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Aplicación&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="tipo" class="form-control" placeholder="Seleccione Tipo" required="required" name="tipos" />
                        <datalist id="tipo">
                            <option value="S">Sólido</option>
                            <option value="L">Líquido</option>
                        </datalist>
                    </div>
                </div> 
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Hectáreas&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="number" name="txthectareas" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="number" name="txtfaja" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" class="form-control" required="required" placeholder="" />
                    </div>
                </div>
            </div>
        </div>       
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=aplicaciones&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>