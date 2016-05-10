<h3><i class="fa fa-angle-right"></i> Crear Usuario</h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=usuarios&a=add" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Cliente: </h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">RUC del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtruc" class="form-control" autofocus required placeholder="Ingrese el RUC si lo tiene" maxlength="12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtnomcli" class="form-control" required placeholder="Ingrese Nombre del Cliente">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Dirección del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdir" class="form-control" required placeholder="Ingrese la Dirección del Cliente">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Teléfono del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="txttelefono" class="form-control" placeholder="Ingrese el Teléfono si lo tiene" maxlength="8">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Celular del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtcelular" class="form-control" placeholder="Ingrese el Celular si lo tiene" maxlength="9">
                    </div>
                </div>
            </div>
        </div>        
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i> Datos del Usuario: </h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre del Usuario</label>
                    <div class="col-sm-10">
                        <input type="text" name="txtuser" class="form-control" required placeholder="Ingrese su Usuario">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" name="txtpass" class="form-control" required placeholder="Ingrese su Contraseña">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo de Usuario</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="cboxtipo">
                            <option selected="selected">Administrador</option>
                            <option>Supervisor</option>
                            <option>Cliente</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div style="text-align: center;">
                <input type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03" />&nbsp;
                <a href="index.php?c=usuarios&a=index"><input type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04" /></a>
            </div>
        </div>
    </div>
</form>