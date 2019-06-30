<?php

class ControllerCanvas {
        
    public static function display(){  
        
        
        $controller = 'canvas';
        $view= 'detail' ;
        require (File::build_path(array('view' , $controller , "$view.php")));      
    }
}


?>
