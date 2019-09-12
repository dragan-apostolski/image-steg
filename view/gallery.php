<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Gallery</title>

  <link href="<?= VENDOR_URL . "bootstrap/css/bootstrap.min.css"?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "simple-sidebar.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "gallery-styles.css" ?>" type="text/css" rel="stylesheet">
  <link href="https://www.w3schools.com/w3css/4/w3.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
  <script src="<?= VENDOR_URL . "jquery/jquery.min.js" ?>"></script>
  <script src="<?= VENDOR_URL . "bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
  <script>
    $(document).ready(function(){
      <?php if (isset($data)): ?>
               setColumnCount(<?php echo count($data)?>);
            <?php endif; ?>
        });
    function setColumnCount(numberOfImages){
      let gallery = document.getElementById('gallery');
      if (numberOfImages <= 2){
        gallery.style.columnCount = 1;
      }
      if(numberOfImages >= 5){
        gallery.style.columnCount = 3;
      }
    }
  </script>
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
              <a class="nav-link btn-text" href="<?= BASE_URL . "home"?>">Steganize</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn-text" href="<?= BASE_URL . "gallery"?>">Gallery<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link btn-text dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $_SESSION["username"] ?>
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

        <div id="gallery-title">
          <h2 class='heading'>This is a gallery of your saved images </h2>
        </div>
        <?php if (empty($data)): ?>
            <p class='info-paragraph'> <?= $_SESSION["username"]?>, your gallery is 
              empty as you have not saved any images.</p>
          <?php endif; ?>

        <div id='gallery' class="gallery">
          <?php foreach ($data as $image): ?>
          <div class="image-data-container" >
            <form method="GET" action="gallery/edit">
                <input type="hidden" name="id" value="<?= $image["id"] ?>" />
                <p class='info-paragraph'><em><?= $image["image_name"] ?></em></p>
                <img src="<?= $image["image_data"] ?>">
                <div class="progress progress-bar-wrapper pb">
                  <div class="progress-bar progress-bar-striped" role="progressbar"
                      aria-valuemin="0" aria-valuemax="100" 
                      style="width: <?= $image["used_capacity"]  ?>;">
                      <?= $image["used_capacity"] ?>
                  </div>
                </div>
                <div class="buttons">
                  <input type="submit" value="Edit" name="action" class="btn btn-primary btn-text">
                  <input type="submit" value="Delete" name="action" class="btn btn-primary btn-text">
                </div>
            </form>
          </div>
          <?php endforeach; ?>
        </div>
    </div>
  </div>

</body>