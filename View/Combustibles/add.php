<h3><i class="fa fa-angle-right"></i> Crear Combustible</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=combustibles&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Combustible:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Combustible</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnombre" class="form-control" required placeholder="Ej: Gasoil" onkeypress="return validarTexto(event)" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Stock del Combustible</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtstock" class="form-control" required placeholder="Ej: 15" onkeypress="return validarNumero(event)" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Carga</label>
                    <div class="col-sm-10">
                        <input type="date" name="dtfecha" class="form-control" required  value="<?php echo date('Y-m-d')?>"/>
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
                <a href="index.php?c=combustibles&a=index"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
            </div>
        </div>
    </div>
</form>