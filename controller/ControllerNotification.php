<?php 


class ControllerNotification{
    
    public static function display(){
        $controller = 'notification';
        $view= 'detail' ;
        require (File::build_path(array('view' , $controller , "$view.php")));
    }
    
}

?>