<h3><i class="fa fa-angle-right"></i>&nbsp;Estadísticas</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<ul class="nav nav-tabs" role="tablist" id="myTab">
    <li class="active"><a href="#g1" role="tab" data-toggle="tab">Hectáreas</a></li>
    <li><a href="#g2" role="tab" data-toggle="tab">Horas de vuelo por piloto</a></li>
    <li><a href="#g3" role="tab" data-toggle="tab">Horas de vuelo por aeronave</a></li>
</ul>
<br />
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="g1">
        <h4><i class="fa fa-angle-right"></i>&nbsp;Hectáreas</h4>
        <div class="panel-body">
            <div id="hero-graph"></div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="g2">
        <h4><i class="fa fa-angle-right"></i> Horas de vuelo por piloto</h4>
        <div class="panel-body">
            <div id="hero-graph2"></div>			
        </div>
    </div>	
    <div role="tabpanel" class="tab-pane" id="g3">
        <h4><i class="fa fa-angle-right"></i> Horas de vuelo por aeronave</h4>
        <div class="panel-body">
            <div id="hero-graph3"></div>			
        </div>
    </div>	
</div>
<script>
    //morris chart
    $(function () {
        // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
        var tax_data = [
        <?php foreach ($estadistica as $dato) { 
                $total = $dato[2] + $dato[3] + $dato[4];
                echo '{"Mes": "'.$dato[1].'-'.$dato[0].'", "Total":'.$total.', "Cantidad de Sólidas":'.$dato[2].' , "Cantidad de Líquidas":'.$dato[3].' , "Cantidad de Siembras":'.$dato[4].'  },' ;      
            } ?>
        ];
        var tax_info = [
            'Total','Cantidad de Sólidas','Cantidad de Líquidas','Cantidad de Siembras'
        ];
        Morris.Bar({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'Mes',
            ykeys: tax_info,
            labels: tax_info,
            barColors:['#7a92a3','#4da74d','#0b62a4','#FE2E2E']
        });
    });
</script>
<script>
    var graph_per = [
        <?php
            $aux = $pilotos;
            $max = 0;
            foreach ($pilotos as $piloto) {        
                if($piloto[0] > $max){
                    $max = $piloto[0];
                    $graph = '{"Mes":  "'.$piloto[1].'-'.$piloto[0].'" , ';
                    foreach($aux as $a){
                        if($max == $a[0]){
                            $graph .= '"'.$a[3].'":'.$a[2].',';
                        }           
                    }
                    $graph .= ' },';
                    echo $graph;
                }
            }     
        ?>
    ];
    var graph_keys = [
        <?php 
            $title = "";
            $unique = [];
            foreach ($pilotos as $piloto) {        
                array_push($unique, $piloto[3]);                                        
            }
            $res = array_unique($unique);
            foreach($res as $r){
                $title .="'".$r."'";
                if(end($res) != $r){
                    $title .= ",";
                }
            }
            echo $title;
        ?>
    ];
        //Horas de vuelo por Persona
    var horas_pil = Morris.Bar({
        element: 'hero-graph2',
        data: graph_per,
        xkey: 'Mes',
        ykeys: graph_keys,
        labels: graph_keys,
        hideHover: 'auto',
        lineWidth: 1,
        pointSize: 5,
        barColors:['#7a92a3','#4da74d','#0b62a4','#FE2E2E','#808000','#008080','#00ffff','#000080','#008000'],
        fillOpacity: 0.5,
        smooth: true
    });
    $('ul.nav a').on('shown.bs.tab', function (e) {
        horas_pil.redraw();
    });
</script>
<script>
    var graph_ver = [
        <?php
            $aux2 = $vehiculos;
            $max2 = 0;
            foreach ($vehiculos as $vehiculo) {        
                if($vehiculo[0] > $max2){
                    $max2 = $vehiculo[0];
                    $graph2 = '{"Mes":  "'.$vehiculo[1].'-'.$vehiculo[0].'" , ';
                    foreach($aux2 as $a){
                        if($max2 == $a[0]){
                            $graph2 .= '"'.$a[3].'":'.$a[2].',';
                        }           
                    }
                    $graph2 .= ' },';
                    echo $graph2;
                }
            }     
        ?>
    ];
    var graph_vs = [
        <?php 
            $title = "";
            $unique = [];
            foreach ($vehiculos as $vehiculo) {        
                array_push($unique, $vehiculo[3]);                                        
            }
            $res = array_unique($unique);
            foreach($res as $r){
                $title .="'".$r."'";
                if(end($res) != $r){
                    $title .= ",";
                }
            }
            echo $title;
        ?>
    ];
    //Horas de vuelo por Avion
    var horas_aero= Morris.Bar({
        element: 'hero-graph3',
        data: graph_ver,
        xkey: 'Mes',
        ykeys: graph_vs,
        labels: graph_vs,
        hideHover: 'auto',
        lineWidth: 1,
        pointSize: 5,
        barColors:['#7a92a3','#4da74d','#0b62a4','#FE2E2E','#808000','#008080','#00ffff','#000080','#008000'],
        fillOpacity: 0.5,
        smooth: true
    });       
    $('ul.nav a').on('shown.bs.tab', function (e) {
        horas_aero.redraw();
    });
</script>