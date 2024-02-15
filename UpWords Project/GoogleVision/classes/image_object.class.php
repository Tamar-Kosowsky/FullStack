<?php

require_once 'connect.class.php';

class ImageObj {
	    
    function __construct(){

    }

    private $id;
    private $game_level_id;
    private $image_name;    
    private $image_lable;    
    private $image_level; 

    public function getId(){
        $id = $this->id;
        return $id;
    }
    public function getCategoryId(){
        $game_level_id = $this->game_level_id;
        return $game_level_id;
    }    
    public function getImageName(){
        $image_name = $this->image_name;
        return $image_name;
    }
    public function getImageLable(){
        $image_lable = $this->image_lable;
        return $image_lable;
    }    
    public function getImageLevel(){
        $image_level = $this->image_level;
        return $image_level;
    }        

    private function rowToObject($row){
        $this->id             = $row['id'];
        $this->game_level_id  = $row['game_level_id'];
        $this->image_name     = $row['image_name'];       
        $this->image_lable    = $row['image_lable'];       
        $this->image_level    = $row['image_level'];       
    }


     // insert new row to image_object table
     public static function addNewImageObject($image_name, $level){
        // conect to DB       
        $con = Connect::connectToDB();        
        // select with query
        $result = mysqli_query($con,"INSERT INTO `image_objects`
                                  (`game_level_id`, `image_name`,`level`) 
                           VALUES ($level,'$image_name',$level)");
        
        $last_id = mysqli_insert_id($con);

        return $last_id;                                  
    }

    // update row ->add new lables rows
    public static function addLablesToImageObject($image_object_id,$array_of_lables){
        // conect to DB  
        $con = Connect::connectToDB();  
        foreach($array_of_lables as $lable){
            $result = mysqli_query($con,"INSERT INTO `image_lables`(`image_objects_id`, `lable`) VALUES ($image_object_id,'$lable')");
        }
       
    }    
     
}
?>