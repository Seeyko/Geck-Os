<?php

require_once '../lib/File.php';
require_once (File::build_path(array('controller','ControllerInventaire.php'))); // chargement du modèle

ControllerInventaire::display();
?>