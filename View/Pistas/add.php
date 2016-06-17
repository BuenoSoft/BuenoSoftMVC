<h3><i class="fa fa-angle-right"></i>Crear Pista</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=pistas&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos de la Pista:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre de la Pista&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required="required" placeholder="Ej: Ruta 3" onkeypress="return validarTextoyNumPC(event)"  tabindex="1"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de la Pista</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcoord" onkeypress="return validarNumeroPC(event);" class="form-control" pattern="[+-]?[\d]{1,3}.{1}?[\d]{1,6},[+-]?[\d]{1,3}.{1}?[\d]{1,6}" placeholder="Ej: -30.434,-57.439" tabindex="2" />
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" tabindex="4"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=pistas&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" tabindex="4"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>        
    </div>
</form>