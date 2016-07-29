<table width="100%">
    <tr>
        <td rowspan="2" class="centrado" width="300" height="500">
            <iframe src="https://embed.windyty.com/?-32.138,-55.833,6,metric.wind.km/h" width="300" height="500" frameborder="0"></iframe>
        </td>
        <td>
            <table style="margin: 0 auto;">
                <tr>
                    <td class="centrado1">El tiempo para Tomas Gomensoro de Code S.A.</td>
                </tr>
                <tr>
                    <td>
                        <div id="cont_317644a5022ed4913ffd10e74b5ef289">
                            <script type="text/javascript" async src="https://www.tiempo.com/wid_loader/317644a5022ed4913ffd10e74b5ef289"></script>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
        <td rowspan="2" width="500"></td>
    </tr>
    <tr>
        <td>
            <?php
require 'simple_html_dom.php';
$html = file_get_html("http://www.cambiomatriz.com.uy/");
?>

<table style="margin: 0 auto;">
    <tr>
        <td class="titulos centrado ancho1">Moneda</td>
        <td class="titulos centrado ancho2">Compra</td>
        <td class="titulos centrado ancho3">Venta</td>
    </tr>
    <tr>
        <td class="celda moneda1"><img src="Public/img/manejo/us.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dolar</td>
        <td class="celda centrado">
            <?php
            $headlines = array();
            $compras = $html->find('td[class=ff_arial fuente_num]', 0)->innertext;
              echo $compras;
            ?>
        </td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 2)->innertext;
            echo $compras;
          ?>        </td>
    </tr>
    <tr>
        <td class="celda"><img src="Public/img/manejo/ARG.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peso Argentino</td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 3)->innertext;
            echo $compras;
          ?>
        </td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 5)->innertext;
            echo $compras;
          ?>
        </td>
    </tr>
    <tr>
        <td class="celda"><img src="Public/img/manejo/br.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Real</td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 6)->innertext;
            echo $compras;
          ?>
        </td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 8)->innertext;
            echo $compras;
          ?>
        </td>
    </tr>
    <tr>
        <td class="celda"><img src="Public/img/manejo/EUR.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Euro</td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 9)->innertext;
            echo $compras;
          ?>
        </td>
        <td class="celda centrado">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 11)->innertext;
            echo $compras;
          ?>
        </td>
    </tr>
    <tr>
        <td class="celda"><img src="Public/img/manejo/ur.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U.Reajustable</td>
        <td class="celda centrado" colspan="2">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 33)->innertext;
            echo $compras;
          ?>
        </td>
    </tr>
    <tr>
        <td class="celda"><img src="Public/img/manejo/ui.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U.Indexada</td>
        <td class="celda centrado" colspan="2">
          <?php
          $headlines = array();
          $compras = $html->find('td[class=ff_arial fuente_num]', 34)->innertext;
            echo $compras;
          ?>
        </td>
    </tr>

</table>
        </td>
    </tr>
</table>