<h3><i class="fa fa-angle-right"></i> Crear Aplicación</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=aplicaciones&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cliente</label>
                    <div class="col-sm-10">
                        <input list="clientes" class="form-control_datalist" placeholder="Seleccione Cliente" required="required" name="cliente" />
                        <datalist id="clientes">
                            <?php
                                foreach ($usuarios as $usuario){
                                    if($usuario->getEstado() == "H") { ?>
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
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento</label>
                    <div class="col-sm-10">
                        <textarea rows="5" cols="67" name="txttrat" required placeholder=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada</label>                                           
                    <div class="col-sm-10">
                        <input type="text" name="txtarea_apl" class="form-control" required placeholder="" /> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcaudal" class="form-control" required placeholder="" />
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Latitud</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordlat" class="form-control" required autofocus placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Longitud</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoordlong" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiIni" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10">
                        <input type="text" name="txttaquiFin" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtviento" class="form-control" required placeholder="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtpadron" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Importe</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtimporte" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" name="dtfechaini" class="form-control" autofocus required="required" value="<?php echo date("Y-m-d\TH:i:s"); ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Aplicación</label>
                    <div class="col-sm-10">
                        <input list="tipo" class="form-control" placeholder="Seleccione Tipo" required="required" name="tipos" />
                        <datalist id="tipo">
                            <option value="Sólido">Sólido</option>
                            <option value="Líquido">Líquido</option>
                        </datalist>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Estado</label>
                    <div class="col-sm-10">
                        <input id="est" list="estado" class="form-control" placeholder="Seleccione Estado" required="required" name="estados" />
                        <datalist id="estado">
                            <option value="Iniciado">Iniciada</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Cancelada">Cancelada</option>
                        </datalist>
                    </div>
                </div> 
            </div> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dosis</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdosis" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Hectáreas</label>
                    <div class="col-sm-10">
                        <input type="text" name="txthectareas" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtfaja" class="form-control" required placeholder="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcultivo" class="form-control" required placeholder="" />
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