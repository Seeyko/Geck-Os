<?php
echo ("<div id='error'>");
echo ("<h1>Page d'erreur</h1>");
if ($error) {
    echo ("<h2>Veuillez contactez l'administrateur : 'hello@tomandrieu.com' en incluant le message d'erreur suivant : </h2><p>$error</p>");
}
echo ("</div>");
?>