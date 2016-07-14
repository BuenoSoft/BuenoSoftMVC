<h3><i class="fa fa-angle-right"></i>&nbsp;Estadísticas</h3>
<p>
    <a href="index.php?c=access&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<div class="col-lg-6">
    <div class="content-panel">
        <h4><i class="fa fa-angle-right"></i>&nbsp;Aplicaciones Mensuales</h4>
        <div class="panel-body">
            <div id="hero-graph" class="graph"></div>
        </div>
    </div>
</div>
<script>
    var Script = function () {
    //morris chart
    $(function () {
      // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
      var tax_data = [
      <?php 
            foreach ($estadistica as $dato) {                 
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
    });

}();
</script>