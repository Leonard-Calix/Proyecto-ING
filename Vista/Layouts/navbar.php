
<!-- NAVBAR ================================================= -->
<nav class="navbar navbar-expand-xl navbar-dark  navbar-togglable fixed-top">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand" href="../Vista/index.php">
      <img style="width: 150px;" src="../Public/img/logo.png" alt="INDIATOURS">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbarCollapse">

      <!-- Social -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item-divider">
          <span class="nav-link">
            <span></span>
          </span>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fab fa-github"></i> 
            <span class="d-xl-none ml-2">
              Facebook
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fab fa-twitter"></i> 
            <span class="d-xl-none ml-2">
              Twitter
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://www.instagram.com/" class="nav-link">
            <i class="fab fa-instagram"></i> 
            <span class="d-xl-none ml-2">
              Instagram
            </span>
          </a>
        </li>
      </ul>

      <!-- Links -->
               
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link " href="../Vista/index.php" id="navbarWelcome">
              Home
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link " href="../Vista/index.php" id="navbarWelcome">
              Popular tours  
            </a>
          </li> 

          <?php 

          if ( isset($_SESSION["usuario"]) && isset($_SESSION["tipo"]) ) {

            if($_SESSION["tipo"]==2){
              $ruta="../Vista/perfil-user.php";
            }
            if($_SESSION["tipo"]==3){
              $ruta="../Vista/perfil-guide.php";
            }if ($_SESSION["tipo"]==1) {
              $ruta="../Vista/user.php";
            }
            

            echo '<li class="nav-item">
            <a href="'.$ruta.'" class="nav-link">
            MY ACCOUNT
            </a>
            </li>';

            echo '<li class="nav-item">
            <a href="../Vista/logout.php" class="nav-link">
            LOGOUT
            </a>
            </li>';

          }else{

            echo '<li class="nav-item">
            <a href="../Vista/sign-in.php" class="nav-link">
            SIGN IN
            </a>
            </li>';
          } 

          ?>

        </ul>            
      </ul>
    </div> <!-- / .navbar-collapse -->
  </div> <!-- / .container -->    
</nav>