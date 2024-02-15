<?php
session_start();
if(isset($_REQUEST['log_user_out'])){
    session_destroy(); //delete all session params
   // unset($_SESSION['user_name']);  // delete one session param
}

header('Location:login.php'); //redirect to url


?>