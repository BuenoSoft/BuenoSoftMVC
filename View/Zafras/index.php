<h3><i class="fa fa-angle-right"></i>&nbsp;Período de Zafras</h3>
<p>
    <a href="index.php?c=aplicaciones&a=index"><button class="btn btn-theme05" tabindex="3"><i class="fa fa-arrow-left"></i>&nbsp;Volver</button></a>&nbsp;
</p>
<div class="content-panel">
    <section id="unseen" style="padding-left: 5px; padding-right: 5px;">
        <p>
            <form name="frmzafra" method="post" action="index.php?c=zafras&a=index">
                <b>Año:&nbsp;</b><input name="txtanio" id="anio" />&nbsp;
                <b>Período Inicial:&nbsp;</b><input name="txtped1" id="pec1" />&nbsp;
                <b>Período Final:&nbsp;</b><input name="txtped2" id="pec2" />
                <input name="btnaceptar" type="button" value="Aceptar" onclick="frmzafra.submit();" class="btn btn-theme01" />
                <a href="index.php?c=pdf&a=zafras" target="_blank">
                    <input type="button" value="Imprimir" class="btn btn-theme01" />
                </a>
            </form>
        </p>
        <table class="table table-bordered table-striped table-condensed">
            <thead>
                <th style="text-align: center;">Período</th>
                <th style="text-align: center;">Hectáreas</th>
                <th style="text-align: center;">Horas</th>
            </thead>
            <tbody>
                <?php
                    $tot_hec = 0;
                    $tot_hs = 0;
                    foreach($periodos as $periodo) {
                        $tot_hec += $periodo[1];
                        $tot_hs += $periodo[2];
                ?>
                        <tr style="text-align: center;">
                            <td><?php echo $periodo[0]; ?></td>
                            <td><?php echo $periodo[1]; ?></td>
                            <td><?php echo $periodo[2]; ?></td>
                        </tr>
                <?php                 
                    }
                    if(count($periodos) > 0){
                ?>
                        <tr style="text-align: center;">
                            <td><b>Total:</b></td>
                            <td><b><?php echo $tot_hec; ?></b></td>
                            <td><b><?php echo $tot_hs; ?></b></td>
                        </tr>   
                    <?php                     
                    } 
                ?>
            </tbody>
        </table>
    </section>
</div>
<script>
    $(function(){
        $("#anio").combodate({
            minYear: [<?php echo $anios[ count($anios)-1 ]; ?>],
            maxYear: [<?php echo $anios[0]; ?>],
            template: 'YYYY',
            format: 'YYYY',
            value: [<?php echo $anios[1]; ?>]
        });
        $("#pec1").combodate({
            minYear: [<?php echo $anios[ count($anios)-1 ]; ?>],
            maxYear: [<?php echo $anios[0]; ?>],
            template: 'D/MM',
            format: 'MM-DD' 
        });
        $("#pec2").combodate({
            minYear: [<?php echo $anios[ count($anios)-1 ]; ?>],
            maxYear: [<?php echo $anios[0]; ?>],
            template: 'D/MM',
            format: 'MM-DD' 
        });
    });
</script>