<?php

require_once (File::build_path(array(
    'model',
    'ModelMission.php'
)));

class ControllerMeteo {
    
    public static function display(){
        
        
        self::readMeteoMission();
    }
    
    public static function getMeteoCamp(){
        
    }
    
    public static function readMeteoMission() {
        
        $mission = ModelMission::getMission(unserialize($_COOKIE['mission'])[0]);
        $title = $mission->get('title');
        $description = $mission->get('description');
        $nbDays = $mission->get('nbDays');
        $temp = $mission->get('temp');
        $meteo = $mission->get('meteo');
        if($meteo == 0) {
            $DescMeteo = "pluvieux";
            $temp += -5;
        } else {
            $DescMeteo = "sec";
            $temp += 5;
        }
        $wind = $mission->get('wind');
        if($wind == 2) {
            $DescWind = "venteux";
            $temp += -5;
        } else {
            $DescWind = "calme";
            $temp += 5;
        }
        
        $controller = 'meteo';
        $view= 'detail' ;
        require (File::build_path(array('view' , $controller , "$view.php")));
    
    }
}


?>
