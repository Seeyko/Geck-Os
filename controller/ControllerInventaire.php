<?php
class ControllerInventaire{
    
    public static $inventaire = array(       
        1 => array(array('K-Way', 1), array(0, 3)),
        2 => array(array('Pantalon', 1), array(0, 1)),
        3 => array(array('T-shirt', 1), array(1, 2) ),
        4 => array(array('Pull', 1), array(0, 3)),
        5 => array(array('Chaussures', 1), array(0, 1)),
        6 => array(array('Lunettes de soleil', 1), array(1)),
        7 => array(array('Parapluie', 1), array(0) ),
        8 => array(array('Foulard', 1), array(1, 3)),
        
        9 => array(array('Bouteilles eau', 1), array(1, 0) ),
        10 => array(array('Ration de nourriture', 1), array(1, 0)),
        
       
    );
    
    
    public static function display(){    
        $controller = 'inventaire';
        $view= 'detail' ;
        require (File::build_path(array('view' , $controller , "$view.php")));      
    }
    
    
    public static function getInventaire(){
               
            $idMission = unserialize($_COOKIE['mission'])[0];
            if($idMission >= 3){
                echo("bravo");
            }else{
                $mission = ModelMission::getMission($idMission);
                $meteo = $mission->get('meteo'); // 1
                
                $vent = $mission->get('wind'); // 'vent'
                
                $cooksMission = array($idMission, array() );
                foreach (self::$inventaire as $item){
                    if(in_array($meteo, $item[1]) !== false || in_array($vent, $item[1]) !== false ){
                        array_push($cooksMission[1], $item[0]);
                    }
                }
                setcookie("mission", serialize($cooksMission), time() + 86400 * 30, "/");
                
            }      
    }

    public static function initInventaire(){
        if(!isset($_COOKIE['mission'])){
            $idMission = 1;
            $mission = ModelMission::getMission($idMission);
            $meteo = $mission->get('meteo'); // 1
            
            $vent = $mission->get('wind'); // 'vent'
            
            $cooksMission = array($idMission, array() );
            foreach (self::$inventaire as $item){
                if(in_array($meteo, $item[1]) !== false || in_array($vent, $item[1]) !== false ){
                    array_push($cooksMission[1], $item[0]);
                }
            }
            setcookie("mission", serialize($cooksMission), time() + 86400 * 30, "/");
        }
    }
    
    public static function changeDisponibility($dispo){
                
        $cooksMission = unserialize($_COOKIE['mission']);
             
        $key = rand(1, sizeof($cooksMission[1]));

        print_r($cooksMission[1][$key][0]);
        //echo($cooksMission[1][0][$key][0]);
        $cooksMission[1][$key][1] = 0;
       
        
        setcookie("mission", serialize($cooksMission), time() + 86400 * 30, "/"); // Pour finir on re set le cookie panier avec notre variable $panier modifiais // Ne pas oublier de serialize($panier) car le cookie ne peut pas stocker des arrays, seulement des strings
    }
    
    public static function reactive($itemName){
        $cooksMission = unserialize($_COOKIE['mission']);
        
        $key = 0;
        foreach ($cooksMission[1] as $c){
            if($c[0] == $itemName){
                $key = array_search(array($c[0], $c[1]), $cooksMission[1]);
                $cooksMission[1][$key][1] = 1;
            }
        }
      
        setcookie("mission", serialize($cooksMission), time() + 86400 * 30, "/"); // Pour finir on re set le cookie panier avec notre variable $panier modifiais // Ne pas oublier de serialize($panier) car le cookie ne peut pas stocker des arrays, seulement des strings
        
        ControllerNotification::display();
    }
}

?>
