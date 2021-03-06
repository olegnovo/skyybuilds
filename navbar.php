<!-- Navigation -->

<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">Skyy Builds</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fa fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="projects.php">Projects</a>
        </li>
        <?php
        if (isset($_SESSION["UserID"]) && ($_SESSION["UserID"] > 0)) {
          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php">Log Out</a>
          </li>

          <?php
        }  else {

          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="login.php">Log In</a>
          </li>
          <?php

        }
        ?>


      </ul>
    </div>
  </div>
</nav>
