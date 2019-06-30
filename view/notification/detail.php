<?php
$inventaire = unserialize($_COOKIE['mission']);
echo("<div id='container'>");

foreach ($inventaire[1] as $item) {
    if ($item[1] == 0) {
        if ($item[0]) {
            echo ("<div class='item'>" .$item[0] . " n'est plus opérationnel ");
            ?>
<button onclick="reactivate('<?php echo($item[0])?>')" >Reactiver</button>
</div>
<?php

}
    }
}
echo("</div>");
?>