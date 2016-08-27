<h3><i class="fa fa-angle-right"></i>&nbsp;Estadísticas</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<ul class="nav nav-tabs" id="myTab">
    <li><a data-toggle="tab" href="#hec">Hectáreas</a></li>
    <li><a data-toggle="tab" href="#per">Horas de vuelo por Persona</a></li>
    <li><a data-toggle="tab" href="#ver">Horas de vuelo por Vehículo</a></li>
</ul>
<br />
<div class="row mt">
    <div class="col-lg-6">
        <div class="content-panel">
            <h4><i class="fa fa-angle-right"></i>&nbsp;Hectáreas</h4>
            <div class="panel-body">
                <div id="hero-graph" class="graph"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Horas de vuelo por persona</h4>
                <div class="panel-body">
                    <div id="hero-graph2" class="graph"></div>			
                </div>
            </div>	
    </div>    
</div>
<div class="row mt">
    <div class="col-lg-6">
	<div class="content-panel">
            <h4><i class="fa fa-angle-right"></i> Horas de vuelo por avion</h4>
            <div class="panel-body">
		<div id="hero-graph3" class="graph"></div>			
            </div>
	</div>	
    </div>
</div>
                      
<script>
    var Script = function () {
    //morris chart
    $(function () {
        // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
        var tax_data = [
        <?php foreach ($estadistica as $dato) { 
                $total = $dato[2] + $dato[3] + $dato[4];
                echo '{"Mes": "'.$dato[1].'-'.$dato[0].'", "Total":'.$total.', "Cantidad de Sólidas":'.$dato[2].' , "Cantidad de Líquidas":'.$dato[3].' , "Cantidad de Siembras":'.$dato[4].'  },' ;      
            } ?>
        ];
        Morris.Bar({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'Mes',
            ykeys: ['Total','Cantidad de Sólidas','Cantidad de Líquidas','Cantidad de Siembras'],
            labels: ['Total','Cantidad de Sólidas','Cantidad de Líquidas','Cantidad de Siembras'],
            barColors:['#7a92a3','#4da74d','#0b62a4','#FE2E2E']
        });
        $('.code-example').each(function (index, el) {
            eval($(el).text());
        });
        /*-------------------------------------------------------------------*/
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
        Morris.Bar({
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
        /*-------------------------------------------------------------------*/
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
        Morris.Bar({
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
    });    
}();		
</script>