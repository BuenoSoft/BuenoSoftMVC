<h3><i class="fa fa-angle-right"></i>Ver Aplicación número&nbsp;<?php echo $aplicacion->getId(); ?></h3>
<p>
    <a href="index.php?c=pdf&a=myapp&d=<?php echo $aplicacion->getId(); ?>" target="_blank">
        <button class="btn btn-theme05" tabindex="3">
            <i class="fa fa-print"></i>&nbsp;Imprimir
        </button>
    </a>
</p>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Aplicación:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Aeronave</label>
                    <div class="col-sm-10" style="text-align: center;">                        
                        <a href="index.php?c=aplicaciones&a=vehiculo&d=<?php echo $aplicacion->getAeronave()->getId();?>">
                            <?php echo $aplicacion->getAeronave()->getMatricula(); ?>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <a href="index.php?c=aplicaciones&a=usuario&d=<?php echo $aplicacion->getCliente()->getId(); ?>">
                            <?php echo $aplicacion->getCliente()->getNomReal(); ?>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Cultivo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCultivo(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tratamiento</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTratamiento(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Área Aplicada</label>                                           
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getAreaapl(); ?>
                    </div>
                </div>                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Caudal</label>                   
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getCaudal(); ?>
                    </div>
                </div>
            </div> 
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tipo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTipo()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Productos</label>
                    <div class="col-sm-10" style="text-align: center;">                        
                        <?php foreach ($aplicacion->getTiene() as $tiene) { ?>
                                <a href="index.php?c=aplicaciones&a=producto&d=<?php echo $tiene->getProducto()->getId(); ?>">
                                    <?php echo $tiene->getProducto()->getNombre()." dosis: ".$tiene->getDosis()."<br />"; ?>
                                </a>
                        <?php } ?>                                                    
                    </div>
                </div>                
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Viento</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getViento(); ?>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Chofer</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <a href="index.php?c=aplicaciones&a=usuario&d=<?php echo $aplicacion->getChofer()->getId(); ?>">
                            <?php echo $aplicacion->getChofer()->getNomReal(); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Terrestre</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <a href="index.php?c=aplicaciones&a=vehiculo&d=<?php echo $aplicacion->getTerrestre()->getId();?>">
                            <?php echo $aplicacion->getTerrestre()->getMatricula(); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Piloto</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <a href="index.php?c=aplicaciones&a=usuario&d=<?php echo $aplicacion->getPiloto()->getId(); ?>">
                            <?php echo $aplicacion->getPiloto()->getNomReal(); ?>
                        </a>                            
                    </div>
                </div>                    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Padrón</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getPadron(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de Cultivo</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo "sur: ".$aplicacion->getGMDLat()."<br /> oeste: ".$aplicacion->getGMDLong(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getPista()->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Faja</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getFaja(); ?>
                    </div>
                </div>                                               
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">                                
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Inicio</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($aplicacion->getFechaIni() == null or $aplicacion->getFechaIni() == "0000-00-00 00:00:00") ? "" : $aplicacion->inverseDateIni(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Fecha de Cierre</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo ($aplicacion->getFechaFin() == null or $aplicacion->getFechaFin() == "0000-00-00 00:00:00") ? "" : $aplicacion->inverseDateFin(); ?>
                    </div>
                </div> 
            </div>
            <div class="showback">    
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Inicial</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiIni(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Taquímetro Final</label>                        
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $aplicacion->getTaquiFin(); ?>
                    </div>
                </div>
            </div>
            <?php if($aplicacion->getCoordCul()!= null and $aplicacion->getCoordCul()!=","){ ?>    
                <div class="showback">   
                    <div class="form-group">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDOPxnk0UHSFpYuJ6bvRqhoK8LD9ZP8Si0'></script>
                        <div>
                            <div id='gmap_canvas' style='height:284px;width:450px;' class="centrarmapa"></div>
                            <style>#gmap_canvas img{
                                max-width:none!important;
                                background:none!important
                                }
                            </style>
                        </div> 
                        <a href='http://maps-generator.com/es'>http://maps-generator.com/</a>
                        <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=09dd514ae2a77ea8d786b93be39d62e07f205aa9'></script>
                        <script type='text/javascript'>
                            function init_map(){
                                var myOptions = {
                                    zoom:13,
                                    center:new google.maps.LatLng(<?php echo $aplicacion->getCoordCul(); ?>),
                                    mapTypeId: google.maps.MapTypeId.SATELLITE
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(<?php echo $aplicacion->getCoordCul(); ?>)
                                });
                                google.maps.event.addListener(marker, 'click', function(){
                                    infowindow.open(map,marker);
                                });
                                infowindow.open(map,marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);
                        </script>
                    </div>
                </div>
            <?php } else { ?>
                <div class="showback">   
                    <div class="form-group"> 
                        <p style="text-align: center;">
                            Coordenadas no ingresadas
                        </p>           
                    </div>
                </div>
            <?php } ?>
        </div>             
    </div>
</div>