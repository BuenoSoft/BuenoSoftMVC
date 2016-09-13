<table width="100%"> 
    <tr>
        <td>
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
                        <img src="Public/img/manejo/espectador.png" height="61" width="300">
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
        <td width="15" style="min-width:15px;"></td>
        <td valign="top">
            <table class="tabletop lateral">
           <tr>
               <td class="centrado titulonoticia">
                   Tomás Gomensoro
               </td>
           </tr>
            <tr> 
                <td> 
                    <div id="cont_6f19c3f02e8c2b5b7368bdb73acfa82d">
                    <script type="text/javascript" async src="https://www.tiempo.com/wid_loader/6f19c3f02e8c2b5b7368bdb73acfa82d"></script>
                    </div
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
                        <td class="celda celdita centrado celditamoneda" colspan="2"><img src="Public/img/manejo/us.png">&nbsp;&nbsp;Dolar</td>
                    </tr>
                    <tr>
                        <td class="titulos centrado">Compra</td>
                        <td class="titulos centrado">Venta</td>
                    </tr>
                    <tr>
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
                        <td class="celda celdita centrado celditamoneda" colspan="2"><img src="Public/img/manejo/ARG.png">&nbsp;&nbsp;Peso Argentino</td>
                    </tr>
                    <tr>
                        <td class="titulos centrado">Compra</td>
                        <td class="titulos centrado">Venta</td>
                    </tr>
                    <tr>
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
                        <td class="celda celdita centrado celditamoneda" colspan="2"><img src="Public/img/manejo/br.png">&nbsp;&nbsp;Real</td>
                    </tr>
                    <tr>
                        <td class="titulos centrado">Compra</td>
                        <td class="titulos centrado">Venta</td>
                    </tr>
                    <tr>
                        <td class="celda celdita centrado">
                           <?php
                            $compra = $html->find('td[class=buy]', 6)->innertext;
                            echo $compra;
                            ?>
                        </td>
                         <td class="celda celdita centrado">
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
</table> 