<?php
require_once (File::build_path(array(
    'model',
    'Model.php'
)));

class ModelMission extends Model
{

    private $id;
    private $title;
    private $description;
    private $nbDays;
    private $temp; 
    private $meteo;
    private $wind;
    
    public function __construct($id=NULL, $title=NULL, $description=NULL, $nbDays=NULL, $temp=NULL, $meteo=NULL, $wind=NULL)
    {
        if(!is_null($id)){
            $this->id = $id;
        }
        if(!is_null($title)){
            $this->title = $title;
        }
        if(!is_null($description)){
            $this->description = $description;
        }
        if(!is_null($nbDays)){
            $this->nbDays = $nbDays;
        }
        if(!is_null($temp)){
            $this->temp = $temp;
        }
        if(!is_null($wind)){
            $this->wind = $wind;
        }
    }
    
    public function get($v){
        return $this->$v;
    }
    public function set($v, $value){
        $this->$v = $value;
    }
    
    public static function getMission($id){
        $sql = "SELECT * from mission WHERE id=:i";
        try {
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                ':i' => $id
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelMission');
            $mission = $req_prep->fetch();
            return $mission;
        } catch (PDOException $e) {
            
            return false;
        }
        
        if (!($mission)) {
            return false;
        }
        return $mission;
    }
    
}
?>