<h3>Registrar Producto para Aplicación número&nbsp;<?php echo $aplicacion->getId();?></h3>
<form class="form-horizontal style-form" method="post" action="index.php?c=tienes&a=add&p=<?php echo \App\Session::get('id'); ?>" name="frmadd">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Producto <font color="red">*</font></label>
                    <div class="col-sm-10">
                        <input list="productos" class="form-control_datalist" placeholder="Seleccione Producto" required="required" name="pro" tabindex="1" autofocus="autofocus"/>
                        <datalist id="productos">
                            <?php 
                                foreach($productos as $producto) { 
                                    if($producto->getEstado() == "H") {
                            ?>
                                        <option value="<?php echo $producto->getId(); ?>"><?php echo $producto->getNombre(); ?></option>
                            <?php                             
                                    }                                 
                                }
                            ?>
                        </datalist>
                        <input type="button" onclick="frmadd.submit();" value="Buscar" class="btn btn-theme01" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div style="text-align: center;">
            <button type="submit" name="btnaceptar" value="Aceptar" class="btn btn-theme03"><i class="fa fa-check"></i>&nbsp;Aceptar</button>&nbsp;
            <a href="index.php?c=tienes&a=index&p=<?php echo App\Session::get('id'); ?>"><button type="button" name="btncancelar" value="Cancelar" class="btn btn-theme04"><i class="fa fa-times"></i>&nbsp;Cancelar</button></a>
        </div>
    </div>
</form>