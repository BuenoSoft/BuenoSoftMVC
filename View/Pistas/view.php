<h3><i class="fa fa-angle-right"></i>&nbsp;Ver Pista número&nbsp;<?php echo $pista->getId(); ?></h3>
<div class="form-horizontal style-form">
    <div class="row mt">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="showback">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Datos de la Pista:</h4>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nombre de la Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $pista->getNombre(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Coordenadas de la Pista</label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo "sur: ".$pista->getGMDLat()."<br /> oeste: ".$pista->getGMDLong(); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Usuario&nbsp;<font color="red">*</font></label>
                    <div class="col-sm-10" style="text-align: center;">
                        <?php echo $pista->getCliente()->getDatoUsu()->getNombre(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <?php if($pista->getCoordenadas()!= null){ ?>    
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
                                    center:new google.maps.LatLng(<?php echo $pista->getCoordenadas(); ?>),
                                    mapTypeId: google.maps.MapTypeId.SATELLITE
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(<?php echo $pista->getCoordenadas(); ?>)
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