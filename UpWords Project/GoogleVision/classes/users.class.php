<?php

require_once 'connect.class.php';

class Users {
	    
    function __construct(){

    }

    private $id;
    private $email;
    private $name;
    

    public function getEmail(){
        $email = $this->email;
        return $email;
    }
    public function getName(){
        $name = $this->name;
        return $name;
    }
    public function getId(){
        $id = $this->id;
        return $id;
    }
    public function getAdmin(){
        $admin = $this->admin;
        return $admin;
    }    

    private function rowToObject($row){
        $this->id            = $row['id'];
        $this->email   = $row['email'];
        $this->name    = $row['name'];       
        $this->admin   = $row['admin'];   
    }




     public static function login($user_email,$user_password){
        // conect to DB
        $con = Connect::connectToDB();        
        // select with query
        $result = mysqli_query($con,"SELECT * FROM `users` where `email`='$user_email' AND `password`='$user_password' AND `valid`=1");
      
    
        $row = mysqli_fetch_array($result);   
        $user = new Users();
        $user->rowToObject($row);                                     

        mysqli_close($con);

        return $user;
       
    }
     
}
?>