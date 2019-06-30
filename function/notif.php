<?php 

require_once '../lib/File.php';
require_once (File::build_path(array('model', 'ModelMission.php')));

require (File::build_path(array(
    'controller',
    'Controller.php'
)));

require (File::build_path(array(
    'controller',
    'ControllerMission.php'
)));

require (File::build_path(array(
    'controller',
    'ControllerMeteo.php'
)));

require (File::build_path(array(
    'controller',
    'ControllerInventaire.php'
)));


require (File::build_path(array(
    'controller',
    'ControllerGPS.php'
)));

require (File::build_path(array(
    'controller',
    'ControllerCanvas.php'
)));

require (File::build_path(array(
    'controller',
    'ControllerNotification.php'
)));

ControllerNotification::display();
?>