<?php

require_once 'connect.class.php';

class Levels {
	    
    function __construct(){

    }

    private $id;
    private $name;
    private $img_path;
    private $text;
    private $sort;    
    
    public function getId(){
        $id = $this->id;
        return $id;
    }
    public function getName(){
        $name = $this->name;
        return $name;
    }    
    public function getImagePath(){
        $img_path = $this->img_path;
        return $img_path;
    }
    public function getText(){
        $text = $this->text;
        return $text;
    }
    public function getSort(){
        $sort = $this->sort;
        return $sort;
    }            

    private function rowToObject($row){
        $this->id       = $row['id'];
        $this->name     = $row['name'];
        $this->img_path = $row['img_path'];
        $this->text     = $row['text'];
        $this->sort     = $row['sort'];      
    }


     // get all levels from DB (levels table)
     public static function  getLevels(){
        // conect to DB
        $con = Connect::connectToDB();        
        // select with query
        $result = mysqli_query($con,"SELECT * FROM `game_level` order by sort desc");

        $levels = []; // empty array [] 
        
        while($row = mysqli_fetch_array($result)){
            
            $levelObj = new Levels();
            $levelObj->rowToObject($row);      
            $levels[] = $levelObj;            
        }            

        mysqli_close($con);

        return $levels;
       
    }
      
}
?>