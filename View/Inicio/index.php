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
                        <img src="Public/img/manejo/espectador.png" width="250">
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
            </table>
        </td>
    </tr>
</table>
