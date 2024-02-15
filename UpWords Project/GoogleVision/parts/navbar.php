
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="direction: ltr;height: 100px;">    
    <div class="container">

      <a class="navbar-brand" href="index.php">
        <img src ="images/logo_flat.png" class="main_logo" />
      </a>
      <div class="start_game" style="color: #ffebeb; cursor:pointer; font-weight: bold;text-decoration: underline;">
        <img src="https://cdn3.iconfinder.com/data/icons/game-3-1/512/refresh-512.png" style="width:87px;" />
      start new game</div>
      <?php if(isset($_SESSION['user_name'])): ?>
       <div style="color:#fff;"> <?php echo "&nbsp;&nbsp;  Hello ".$_SESSION['user_name'] ?></div>

      <?php endif; ?>


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">         
              <img src="images/icons8-home-64.png" style="width: 50px;" />
            </a>
          </li>
   
          <?php if(isset($_SESSION['admin']) && $_SESSION['admin']==1): ?>
            <li class="nav-item">
              <a class="nav-link" href="admin_page.php">
                <img src="images/pluslove.png" style="width: 50px;" />              
              </a>
            </li>
          <?php endif; ?>
          <li class="nav-item">

          <?php if(isset($_SESSION['user_id'])): ?>
              <a class="nav-link" href="logout.php?log_user_out=1">Log out</a>
            <?php else : ?>  
              <a class="nav-link" href="login.php">Login</a>
          <?php endif; ?>                        
          </li>
        </ul>
      </div>
    </div>
  </nav>