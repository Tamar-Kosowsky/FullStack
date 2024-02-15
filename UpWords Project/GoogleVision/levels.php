<?php
session_start();
$items = [];
if(isset($_REQUEST['game_level_id'])){  // if url contains param named -> game_level_id

  require_once 'classes/items.class.php';
  $game_level_id = $_REQUEST['game_level_id'];
  $items = Items::getItems($game_level_id);

}else{ // else redirect user to index page
  header("Location:index.php");
}

// echo '<pre>';
// print_r( $items);die();
// echo '</pre>';

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
    <br><br>
    <div class="lable_text" style="text-align:center;"></div>
    <br>
    <!-- Page Features -->
    <div id="aaa" class="row text-center">    
        <?php if(!empty($items)): ?>
          <?php foreach($items as  $key => $item): ?>
          <div class="col-md-4 mb-4">
          <div class="card h-100">
            
            <img class="card-img-top image_lable" data-item="<?php echo $item->getId(); ?>" src="uploads/<?php echo $item->getImageName(); ?>">    
            
                <?php foreach($item->getImageLable() as $lable): ?>
                  <span data-lable="<?php echo trim($lable); ?>" class="lable_name" style="display: none;"><?php echo trim($lable); ?></span>  
                 <?php endforeach ?>           
          </div>
        </div>
      <?php endforeach; ?>            
        <?php else : ?>    
          <h1>category not found !!</h1>             
        <?php endif; ?>            
    </div>
    <div class="row text-center">  
      <div class="col-12">
        <img src="images/iconfinder_faq_46801.png" class='ask_question shake' style="width: 220px;cursor: pointer;"  />                              
        <img class="btn btn-default reload_game" onClick="window.location.reload()" style="display:none;" data-dismiss="modal" src="images/1628130-middle.png" width="150px;" />
      </div>
    </div>


    <div class="modal fade" id="confirm-next" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Press Next For Level <span class="user_level"></span></h4>
                    <span class="game_level_id" data-lvl="<?php echo $_REQUEST['game_level_id']; ?>" style="display: none;"></span>
                </div>
               
                <div class="modal-footer">                    
                    <img class="btn btn-default" onClick="window.location.reload()" data-dismiss="modal" src="images/1628130-middle.png" width="150px;" />
                    <img class="btn btn-ok" src="images/green-next-button.png" width="150px;" />
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="confirm-end" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">You Have Won With <span class='finel_points'></span> Points</h4>                    
                </div>
               
                <div class="modal-footer">                    
                  <img src="https://cdn3.iconfinder.com/data/icons/game-3-1/512/refresh-512.png" onClick="window.location.reload()"  style="width:87px;">                                        
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
