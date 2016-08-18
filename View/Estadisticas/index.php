<h3><i class="fa fa-angle-right"></i>&nbsp;Estadísticas</h3>
<p>
    <a href="index.php?c=inicio&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a data-toggle="tab" href="#mens">Mensuales</a></li>
    <li><a data-toggle="tab" href="#hec">Hectáreas</a></li>
    <li><a data-toggle="tab" href="#per">Horas de vuelo por Persona</a></li>
    <li><a data-toggle="tab" href="#ver">Horas de vuelo por Vehículo</a></li>
</ul>
<br />
<div class="tab-content">
    <div class="col-lg-6">
        <div id="mens" class="tab-pane active">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Aplicaciones Mensuales</h4>
                <div class="panel-body">
                    <div id="hero-graph" class="graph"></div>
                </div>
            </div>            
        </div>
    </div>     
    <div class="col-lg-6">
        <div id="hec" class="tab-pane">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Hectáreas</h4>
                <div class="panel-body">
                    <div id="hero-area" class="graph"></div>
                </div>
            </div>            
	</div>	
    </div>
    <div class="col-lg-6">
        <div class="content-panel">
            <div id="per" class="tab-pane">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i>&nbsp;Horas de vuelo por persona</h4>
                    <div class="panel-body">
                        <div id="hero-graph2" class="graph"></div>
                    </div>                    
                </div>
            </div>    
        </div>        	
    </div>
    <div class="col-lg-6">
        <div class="content-panel">
            <div id="veh" class="tab-pane">
                <h4><i class="fa fa-angle-right"></i>&nbsp;Horas de vuelo por avion</h4>
                <div class="panel-body">
                    <div id="hero-graph3" class="graph"></div>
                </div>
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
                echo '{"Mes": "'.$dato[1].'-'.$dato[0].'", "Registro":'.$dato[2].' },' ;      
            } ?>
        ];
        Morris.Line({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'Mes',
            ykeys: ['Registro'],
            labels: ['Registro'],
            lineColors:['#4ECDC4']
        });
        $('.code-example').each(function (index, el) {
            eval($(el).text());
        });
      //Esta es la de hectareas
      Morris.Area({
        element: 'hero-area',
        data: [
          {period: '2010-1-2', Avion1: 2666, Avion2: 1000, Avion3:5000 , },
          {period: '2010-1-3', Avion1: 2778, Avion2: 2000, Avion3:4000 ,},
          {period: '2010-1-10', Avion1: 4912, Avion2: 3000, Avion3:3000 ,},
          {period: '2010-1-15', Avion2: 4000, Avion3:4000 , Avion2:2000},
          {period: '2010-1-20', Avion1: 6810, Avion2: 5000, Avion3:1000 ,},
        
        ],

          xkey: 'period',
          ykeys: ['Avion1', 'Avion2', 'Avion3'],
          labels: ['Avion1', 'Avion2', 'Avion3'],
          hideHover: 'auto',
          lineWidth: 1,
          pointSize: 5,
          lineColors: ['#4a8bc2', '#ff6c60', '#a9d86e'],
          fillOpacity: 0.5,
          smooth: true
      });
      
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
            lineColors: ['#4a8bc2', 'red','green' ],
            fillOpacity: 0.5,
            smooth: true
        });
        var graph_ver = [
            <?php
                $aux = $vehiculos;
                $max = 0;
                foreach ($vehiculos as $vehiculo) {        
                    if($piloto[0] > $max){
                        $max = $piloto[0];
                        $graph = '{"Mes":  "'.$vehiculo[1].'-'.$vehiculo[0].'" , ';
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
        Morris.Bar()({
            element: 'hero-graph3',
            data: graph_ver,
            xkey: 'Mes',
            ykeys: graph_vs,
            labels: graph_vs,
            hideHover: 'auto',
            lineWidth: 1,
            pointSize: 5,
            lineColors: ['#4a8bc2', '#ff6c60', '#a9d86e'],
            fillOpacity: 0.5,
            smooth: true
      });
      
    });
    
}();
		

</script>
