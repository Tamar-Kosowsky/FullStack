<?php
 session_start();
  require_once 'classes/levels.class.php';  
  
  $levels = Levels::getLevels();

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
  <div class="container" style="margin-top: 100px;">
    <br><br><br>
    <!-- Page Features -->
    <div class="row text-center">
    
      <?php foreach($levels as $levels):?>

        <div class="col-md-4 mb-4">
        <div data-link="levels.php?game_level_id=<?php echo $levels->getId(); ?>" class="btn level_link" style="background-color: #ffffff65;">
        <!-- <button onclick="playAudio()" type="button" id="play" style="display:inline-block;">Play/Resume table</button> -->
          <div class="card h-100" style="background: none;" onclick="playAudio()">
            <img class="card-img-top" src="images/<?php echo $levels->getImagePath(); ?>" style="height: 355px;">  
            <div style="background-image: url('images/star_bg_points.png');width: 65px;background-size: cover;height: 65px;position: absolute;bottom: 9px;left: 10px;">
                <span style="position: relative; top: 20px;font-size: 22px;" class="level_<?php echo $levels->getId(); ?>"></span>    
            </div>  
          </div>
       </div>
        </div>
      <?php endforeach; ?>
    </div>
    <!-- /.row -->
  </div>
    <!-- /.container -->
  <?php require_once 'parts/footer.php'; ?>
  <?php require_once 'parts/site_scripts.php'; ?>
</body>

</html>
