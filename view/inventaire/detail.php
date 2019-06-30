<?php
$inventaire = unserialize($_COOKIE['mission']);
echo("<div id='container'>");
echo("<div class='item'>Mission : " . $inventaire[0] . '</div>');
foreach ($inventaire[1] as $item) {
    echo ("<div class='item'>" . $item[0] . ( ($item[1] == 0) ? ' Indisponible' : ' Disponible'));
    echo("</div>");
}
echo("</div>");
?>