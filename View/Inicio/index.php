<table width="100%"> 
    <tr>
        <td width="63%">
            <?php
            header('Content-Type: text/html; charset=utf-8');
            //if (!ini_get('date.timezone')) {
              //  date_default_timezone_set('America/Argentina');
            //}
            require_once 'Lib/Feed.php';
            $rss = Feed::loadRss('http://www.espectador.com/rss/agro.xml');
            ?>
            <table style="margin: 0 auto;">
                <tr>
                    <td>
                        <img src="Public/img/manejo/espectador.png">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <i>
                                <?php echo htmlSpecialChars($rss->description) ?>
                            </i>
                        </p>
                     </td>
                </tr>
            </table>
            <?php foreach ($rss->item as $item): ?>
            <h2>
                <a href="<?php echo htmlSpecialChars($item->link) ?>" class="titulonoticia" ><?php echo htmlSpecialChars($item->title) ?></a>
                <small class="horanoticia">
                    <?php echo date("j.n.Y", (int) $item->timestamp) ?>
                </small>
            </h2>
            <?php if (isset($item->{'content:encoded'})): ?>
                <div>
                    <?php 
                    echo $item->{'content:encoded'} 
                    ?>
                </div>
            <?php else: ?>
            <p  align="justify"class="textonoticia">
                    <?php 
                    echo htmlSpecialChars($item->description) 
                    ?>
                </p>
            <?php endif ?>
            <?php endforeach ?>

        </td>
        <td>
        <table class="tabletop">
            <tr>
                <td class="centrado1">El tiempo para Tomás Gomensoro de Code S.A.</td>
            </tr>
            <tr>
                <td>
                    <div id="cont_106d4e80ed2ff0054aa5ee200e05185b">
                        <script type="text/javascript" async src="https://www.tiempo.com/wid_loader/106d4e80ed2ff0054aa5ee200e05185b"></script>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <?php
                require 'Lib/simple_html_dom.php';
                $html = file_get_html("http://www.bancorepublica.com.uy/c/portal/render_portlet?p_l_id=123137&p_p_id=ExchangeLarge_WAR_ExchangeRate5121_INSTANCE_P2Af&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&p_p_col_id=column-2&p_p_col_pos=0&p_p_col_count=1&currentURL=%2Fweb%2Fguest%2Finstitucional%2Fcotizaciones");
                ?>
                <table class="estilotabla">
                    <tr>
                        <td class="titulos centrado ancho1">Moneda</td>
                        <td class="titulos centrado ancho2">Compra</td>
                        <td class="titulos centrado ancho3">Venta</td>
                    </tr>
                    <tr>
                        <td class="celda celdita"><img src="Public/img/manejo/us.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dolar</td>
                        <td class="celda celdita centrado">
                            <?php
                            $compra = $html->find('td[class=buy]', 0)->innertext;
                              echo $compra;
                            ?>
                        </td>
                        <td class="celda celdita centrado">
                            <?php
                            $venta = $html->find('td[class=sale]', 0)->innertext;
                            echo $venta;
                            ?>        
                        </td>
                    </tr>
                    <tr>
                        <td class="celda celdita"><img src="Public/img/manejo/ARG.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peso Argentino</td>
                        <td class="celda celdita centrado">
                            <?php
                            $compra = $html->find('td[class=buy]', 4)->innertext;
                            echo $compra;
                            ?>
                        </td>
                        <td class="celda celdita centrado">
                            <?php
                            $venta = $html->find('td[class=sale]', 4)->innertext;
                            echo $venta;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="celda celditabr"><img src="Public/img/manejo/br.png">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Real</td>
                        <td class="celda celditabr centrado">
                            <?php
                            $compra = $html->find('td[class=buy]', 6)->innertext;
                            echo $compra;
                            ?>
                        </td>
                        <td class="celda celditabr centrado">
                            <?php
                            $venta= $html->find('td[class=sale]', 6)->innertext;
                            echo $venta;
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
 </table> 
