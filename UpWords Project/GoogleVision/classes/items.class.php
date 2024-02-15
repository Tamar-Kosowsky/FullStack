<?php

require_once 'connect.class.php';

class Items {
	    
    function __construct(){

    }

    private $id;
    private $game_level_id;
    private $image_name; 
    private $image_lable;   


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

    // private function rowToObject($row){
    //     $this->id            = $row['id'];
    //     $this->game_level_id   = $row['game_level_id'];
    //     $this->image_name    = $row['image_name'];       
    //     $this->image_lable[]    = $row['lable']; 
    // }


     // get all items from DB (category table)
     public static function  getItems($game_level_id){
        // conect to DB
        $con = Connect::connectToDB();        
        // select with query

        $result = mysqli_query($con,"SELECT DISTINCT image_objects.id, image_objects.game_level_id, image_objects.image_name, image_objects.level FROM `image_objects` WHERE `game_level_id` = $game_level_id ORDER BY RAND() LIMIT 3");
        
        $items  = []; // empty array []                  
        
        $all_distinct_lables = [];        
        $comma_seperate_lables = '';
        while($row = mysqli_fetch_array($result)){
            
            $obj_distinct_lables = [];

            $itemObj = new Items();
            $image_object_id        = $row['id'];
            $itemObj->id            = $image_object_id;
            $itemObj->game_level_id = $row['game_level_id'];
            $itemObj->image_name    = $row['image_name']; 
            

            if(empty($all_distinct_lables)){                
                $lables_res = mysqli_query($con,"SELECT DISTINCT  `lable` FROM `image_lables` 
                                                 INNER JOIN `image_objects` ON `image_lables`.`image_objects_id` = `image_objects`.`id`
                                                  WHERE `image_objects`.`id` =$image_object_id");    

                while($row = mysqli_fetch_array($lables_res)){
                    $all_distinct_lables[]= "'".$row[0]."'"; 
                    $obj_distinct_lables[] = $row[0];
                }                                             
                $comma_seperate_lables = implode(",",$all_distinct_lables);
                $itemObj->image_lable = $obj_distinct_lables;// implode(",",$obj_distinct_lables);
                
            }else{
              
                $lables_res = mysqli_query($con,"SELECT  DISTINCT  `lable` FROM `image_lables` 
                INNER JOIN `image_objects` ON `image_lables`.`image_objects_id` = `image_objects`.`id`
                WHERE `image_objects`.`id` =$image_object_id
                AND `image_lables`.`lable` NOT IN ($comma_seperate_lables)");
 
                
                while($row = mysqli_fetch_array($lables_res)){
                    $all_distinct_lables[]= "'".$row[0]."'";
                    $obj_distinct_lables[] = $row[0];                    
                }  

                $comma_seperate_lables = implode(",",$all_distinct_lables);
                $itemObj->image_lable  = $obj_distinct_lables; //implode(",",$obj_distinct_lables);
            }
           
            $items[] = $itemObj;                    
        }                    

        mysqli_close($con);
        
        return $items;
       
    }
     
}
?>