<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Edit profile</title>

  <link href="<?= VENDOR_URL . "bootstrap/css/bootstrap.min.css"?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "simple-sidebar.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "login-styles.css" ?>" type="text/css" rel="stylesheet">
  <link href="https://www.w3schools.com/w3css/4/w3.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
  <script src="<?= VENDOR_URL . "jquery/jquery.min.js" ?>"></script>
  <script src="<?= VENDOR_URL . "bootstrap/js/bootstrap.bundle.min.js" ?>"></script>

</head>
<body>
    <div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <!-- <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button> -->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                    <a class="nav-link btn-text" href="<?= BASE_URL . "home"?>">Steganize<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn-text" href="<?= BASE_URL . "gallery"?>">Gallery</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn-text active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$_SESSION["username"]?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item btn-text" href="<?= BASE_URL . "profile" ?>">Edit profile</a>
                        <div class="dropdown-divider"></div>  <!-- Menu Toggle Script -->
                        <script>
                        
                        </script>
                        <a class="dropdown-item btn-text" href="<?= BASE_URL . "logout"?>">Log out</a>
                    </div>
                    </li>
                </ul>
            </div>
        </nav>

    <div id="login-wrapper">

    <?php if (!empty($errorMessage)): ?>
      <h2 class="important heading" style="color: red;"><?= $errorMessage ?></h2>
    <?php endif; ?>

    <?php if (empty($errorMessage)): ?>
      <h2 class='heading'> Change your user credentials</h2>
    <?php endif; ?>
    <form id="login_form" method="POST" action="<?= BASE_URL . "profile/change" ?>">
      <div id="login-container">
        <div class="login-item">
          <label for="username" class='info-paragraph'>Username</label> 
          <input type="text" readonly value="<?= $_SESSION["username"] ?>" class="btn btn-primary btn-text" name="username" autocomplete="off" required autofocus />
        </div>
        <div class="login-item">
          <label for="old_password" class='info-paragraph'>Current password</label>
          <input type="password" class="btn btn-primary btn-text" name="current_password" required />
        </div>
        <div class="login-item">
          <label for="new_password" class='info-paragraph'>New password</label>
          <input type="password" class="btn btn-primary btn-text" name="new_password" required />
        </div>
        <button class="btn btn-primary btn-text" class='info-paragraph'>Change password</button>
      </div>
    </form>
    <br>
    </div>
    </div>
    </div>

    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close btn-text" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="modal-body" class="modal-body">
            Password updated succesfully!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-text" data-dismiss="modal">Close</button>
            <form method="GET" action="<?= BASE_URL . "home" ?>">
              <input type="submit" value="Home" class="btn btn-primary">
            </form>
            <form method="GET" action="<?= BASE_URL . "gallery" ?>">
              <input type="submit" value="Gallery" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div>


    <script>
         $(document).ready(function(){
            <?php if (isset($success)): ?>
              $("#info-modal").modal("show");
            <?php endif; ?>
    });
    </script>
</body>