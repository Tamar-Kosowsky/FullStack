<?php
  session_start();

  require_once 'vendor/autoload.php';
  require_once 'classes/users.class.php';  
  require_once 'classes/image_object.class.php';  
  require_once 'classes/google_vision.class.php';  

  
  $user_msg = '';
  $flag = 0;
  $object_image_path = 'uploads/';
  
  // $_REQUEST = $_POST or $_GET

  // if having a request name file_name
  if(isset($_REQUEST['file_name']) && !empty($_REQUEST['file_name'])){
          
    // if image file exist
    if(isset($_FILES['image'])){
      
      // if request value contains level -> if not set to 1
       $level_type = (isset($_REQUEST['level_type'])) ? $_REQUEST['level_type'] : 1;      
       $errors= '';
       $file_name = $_FILES['image']['name'];
       $file_size =$_FILES['image']['size'];
       $file_tmp =$_FILES['image']['tmp_name'];
       $file_type=$_FILES['image']['type'];       
       
       // seperate before and after dot 348957349573894579.jpg
       $file_ext=explode('.', $file_name );
                    
       // create file name using hash(md5( file name + time)  ) 
       $new_file_name= md5($_REQUEST['file_name'].time());
       $expensions= array("jpeg","jpg","png","JPEG","JPG","PNG");
 
       // validate image extentions jpeg","jpg","png","JPEG","JPG","PNG
       if(in_array($file_ext[1],$expensions)=== false){
          $user_msg="extension not allowed, please choose a JPEG or PNG file.";
          $errors = "fail";
       }
       
       // if no errors
       if(empty($errors)==true){      
        
        // full_file_name = filename.extention        
        $full_file_name = $new_file_name.".".$file_ext[1];

        // get user image and move it to uploads folder   move_uploaded_file("uploads/new file name.png")
         move_uploaded_file($file_tmp,$object_image_path.$full_file_name);                      
                  
         // insert new image  item to DB and return last inserted id
        $last_id = ImageObj::addNewImageObject($full_file_name, $level_type);

        // if new image_objects row added to DB
        if(!empty($last_id)){

          // sent request to google vision with the image the admin upload
           //return object with diffrent arrays
          $lables = GoogleVisionInternal::getImageLables($full_file_name);
            
          $flag = 1;
        }else{
          $user_msg = 'No Labels found';
        }
        // get lables from google vision API                 
       
       }
        
    }                
}

if(isset($_REQUEST['image_object_id'])){  
    ImageObj::addLablesToImageObject($_REQUEST['image_object_id'],$_REQUEST['img_lable']);

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

<?php if(!empty( $user_msg )): ?>
  <?php echo  $user_msg ; ?>
<?php endif; ?>

    <!-- Upload Image Form -->

    <?php if(!empty($user_msg)){echo $user_msg;} ?>

    <?php if($flag): ?>


        <div class="container" style=" position: relative;  top: 150px;">
          <div class="row">
            <div class="col-4">
                <img src="<?php echo  $object_image_path.$full_file_name; ?>" style="    width: 100%;" />
            </div>
        
            <div class="col-8">
              
                <div class="col-12">

              
                <form id="level_form" class="row" action="admin_page.php" method="post" style="font-size:18px;overflow: scroll; height:600px;">    
                  <div class="col-6">
                    <input type="submit" value="save" />
                  </div>
                  <div class="col-6" style="background-color: #fff;">
                                                      
                      <?php $counter = 1; ?>
                      <?php foreach($lables as $key=>$label): ?>                        
                        <div id="<?php echo $counter; ?>" class="object_wrapper">
                        <div> 
                          <span> : Object Description </span><span><?php echo $label->info()['score']; ?></span>                  
                        </div>
                        <div style="padding: 3px;"> 
                          <input type="hidden" name="image_object_id" value="<?php echo  $last_id; ?>" />
                          <input type="text" title="edit image title" class="img_input" style="" name="img_lable[]" value="<?php echo $label->info()['description']; ?>"  />     
                          <button class="btn_style remove_obj">X</button>
                        </div>                  
                        </div>     
                        <?php $counter++; ?>        
                      <?php endforeach; ?>            
                  
                  </div>

                
                </form>
                </div>

              </div>
          </div>
        </div>



    <?php else : ?>
        <!-- Icon -->


<div class="container" style="margin-top: 100px; min-height:700px;">
    <br><br><br>
    <!-- Page Features -->
    <div class="row text-center">

    <div class="wrapper fadeInDown">
    <div id="formContent">
    <!-- Tabs Titles -->        
        <div class="fadeIn first">
        <img style="width:60px;" src="https://cdn1.iconfinder.com/data/icons/app-user-interface-glyph/64/user_man_user_interface_app_person-512.png" id="icon" alt="User Icon" />
      </div>

         <!--
           admim fill in the form with level and image 
          after pressing submit it will send post request to admin_page.php
          with this params image,file_name,level_type
          handle request -> on top of the page
        -->
        <form action="admin_page.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>        
                <input type="file"  name="image" style="width:100%; color: #e155f0;" />
                <input type="hidden" name="file_name"  value="1"   style="width:100%;" />           
                <div>
                    <input type="text" name="level_type" class="img_input"  value="" maxlength="1"   style="width:50px;" />
                  <span> : level </span>
                </div>
                <input type="submit" value="upload" />
            </div>
        </form>
    <?php endif; ?>

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
