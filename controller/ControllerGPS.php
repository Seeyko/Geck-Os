<?php

class ControllerGPS {
        
    public static function display(){  
        
        $controller = 'gps';
        $view= 'detail' ;
        
        require (File::build_path(array('view' , $controller , "$view.php")));      
    }
}


?>