<?php
  session_start();
 // TODO:Logout
 
  require_once 'classes/levels.class.php';  
  require_once 'classes/users.class.php';  

  $categories = Levels::getLevels();
  $user_msg = '';

if(isset($_SESSION['user_id'])){
  header("Location:index.php");
}


  if(isset($_REQUEST['user_email']) && isset($_REQUEST['user_password']) && isset($_REQUEST['token']) ){
    
    if($_REQUEST['token']==$_SESSION['token'] ){
        $user_email = $_REQUEST['user_email'];
        $user_password = $_REQUEST['user_password'];
        $user = Users::login($user_email,$user_password);
        
        if(empty($user)){
          // if login failed
          $user_msg = 'משתמש זה אינו נמצא';
        }else{    
          // if log in success 
            $_SESSION['user_name'] = $user->getName();
            $_SESSION['user_id']   = $user->getId();
            $_SESSION['admin']     = $user->getAdmin();
            header("Location:index.php");
        }        
    }else{
      $user_msg = 'שליחת טופס אינה חוקית';
    }

  }else{
    $user_msg = 'שליחת טופס אינה חוקית';    
  }


  if(!isset($_SESSION['token'])){
    $token = md5(time());
    $_SESSION['token'] = $token;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once 'parts/head_tags.php'; ?>
</head>

<body>

  <!-- Navigation -->
  <?php require_once 'parts/navbar.php'; ?>

  <!-- Page Content -->
  <div class="container" style="margin-top: 100px; min-height:700px;">
    <br><br><br>
    <!-- Page Features -->
    <div class="row text-center">
        
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img style="width:60px;" src="https://cdn1.iconfinder.com/data/icons/app-user-interface-glyph/64/user_man_user_interface_app_person-512.png" id="icon" alt="User Icon" />
    </div>

<?php if(!empty( $user_msg )): ?>
  <?php echo  $user_msg ; ?>
<?php endif; ?>

    <!-- Login Form -->
    <form id="login_form" action="login.php" method="post">      
      <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
      <input type="email" id="login_email" class="fadeIn second" name="user_email" placeholder="example@gmail.com">
      <input type="password" id="login_password" class="fadeIn third" name="user_password" placeholder="password">      
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
    <div id="login_form_errors">
        <div class='email_err validation_error'></div>
        <div class='pass_err validation_error'></div>
    </div>
    <!-- Remind Passowrd -->
    <div id="formFooter">      
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
    </div>
    <!-- /.row -->

  </div>
    <!-- /.container -->
  <?php require_once 'parts/footer.php'; ?>
  <?php require_once 'parts/site_scripts.php'; ?>
</body>

</html>
