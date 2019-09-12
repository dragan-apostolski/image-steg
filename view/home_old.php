<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Image Steganization</title>

  <link href="<?= VENDOR_URL . "bootstrap/css/bootstrap.min.css"?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "simple-sidebar.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "home.css" ?>" type="text/css" rel="stylesheet">
  <link href="https://www.w3schools.com/w3css/4/w3.css" type="text/css" rel="stylesheet" >
</head>

<body>

  <div class="d-flex" id="wrapper">
<!-- 
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
      </div>
    </div> -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <!-- <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button> -->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="<?= BASE_URL . "home"?>">Steganography<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL . "gallery"?>">Gallery</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Profile
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Edit profile</a>
                <div class="dropdown-divider"></div>  <!-- Menu Toggle Script -->
                <script>
                 
                </script>
                <a class="dropdown-item" href="<?= BASE_URL . "logout"?>">Log out</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      
      <div id="container-file-drop">
            <?php if (!empty($_SESSION["username"])): ?>
              <h3>Hello, <?=$_SESSION["username"]?>. Welcome to the image steganization page.</h3>
            <?php endif; ?>
            <h2 class="heading">Give us your image here</h2>
            <p class="info-paragraph">The selected image is the file in which you can encode your messages.<br>
              After selecting the image, you can encode the messages you want in the image.
            </p>
            <br>
            <div id="drop-zone">
                <p>Drop your image here.</p>
            </div>
            
            <div id="browse-zone">
              <p>Or select an image from your file system.</p>
              <label for="file-upload" class="btn btn-primary">
                <i class="fa fa-cloud-upload"></i> Choose File
              </label>
            <input id="file-upload" type="file" accept="image/png, image/jpeg" onchange="handleFileSelect(this)"/>
            </div>
        </div>

      <div id='steg-container'>
        <h2 class="heading">Steganize your image here</h2>
        <p class="info-paragraph">Here is your selected image.<br>
        Below the image, you can give us the data that you want to encode (hide) in this image.</p>
        <br>
        <img id="image-container">
        <br>
        <div class="download-save-container">
            <a id="download-anchor" class="btn btn-primary" rel="nofollow">Download image</a>
            <button id="save-button" class="btn btn-primary" 
                onclick="btnSaveToGalClick()">Save to gallery</button> 
        </div>
        <br>
        <div id="progress-bar-wrapper" class="progress">
          <div id="progress-bar" class="progress-bar progress-bar-striped" role="progressbar"
              aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <p><em>This progress bar shows how much space in the image is used for encoding data.</em></p> 
        
        <br>

      <div id="messages">
          <div id="encoding-form">
            <p class="info-paragraph">Add message</p>
            <br>
            <input type="text" id="message-title" placeholder="Title (optional)" class="btn btn-primary message-title">
            <br>
            <textarea id='message-text' class="btn btn-primary message-box" 
                placeholder="Enter your secret message here"></textarea>
            <br>
            <button class="btn btn-primary" id='btnEncode' onclick="onBtnEncodeClick()">Encode</button> 
          </div>

          <div id="messages-container">
            <p class="info-paragraph">View/edit messages</p>
            <br>
            <select id="message-select" class="btn btn-primary message-title"></select>
            <br>
            <div id="title-edit-container">
              <input type="text" id="message-title-edit" class="btn btn-primary message-title">
            </div>
            <textarea id="message-view" readonly class="btn btn-primary message-box"></textarea>
            <br>
            <button class="btn btn-primary" id='btnEdit' onclick="onBtnEditClick()">Edit</button>
            <div id="cancel-update-cont">
              <button class="btn btn-primary" id='btnUpdate' onclick="onBtnUpdateClick()">Update</button> 
              <button class="btn btn-primary" id='btnCancel' onclick="onBtnCancelClick()">Cancel</button> 
            </div>
          </div>
      </div>

    </div>
    </div>

    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <script src="<?= VENDOR_URL . "jquery/jquery.min.js" ?>"></script>
  <script src="<?= VENDOR_URL . "bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
  <script src="<?= JS_URL . "steganography-js/steganography.js" ?>"></script>
  <script src="<?= JS_URL . "encoding_session.js" ?>"></script>
  <script src="<?= JS_URL . "the_javascript.js" ?>"></script>
  <script>
    $(document).ready(function(){
        <?php if (isset($_SESSION["edit_image"])): ?>
          messages = <?php echo $_SESSION["edit_image"]["image_messages"];?>;
          imageName = "<?php echo $_SESSION["edit_image"]["image_name"];?>";
          $("#steg-container").css("display", "flex");
          $("#image-container").attr("src", "<?= $_SESSION["edit_image"]["image_data"] ?>");
          $('html, body').animate({
            scrollTop: $("#steg-container").offset().top}, 1000);
          updateMessageList(messages);
        <?php endif; ?>
    });

    function btnSaveToGalClick(){
      img = document.getElementById("image-container").src;
      url = "<?= BASE_URL . "gallery/add"?>";
      usedCapacity = document.getElementById("progress-bar").style.width;
      $.post(
            url,
            {image: img, imageName: imageName, 
              messages: JSON.stringify(messages), usedCapacity: usedCapacity},
            function(response){
                 if(response == 1){
                   alert("Image successfully added to gallery.")
                 }
                 else{
                   alert("An error occured while adding the image to the gallery.")
                 }
            }
      );
    }
  </script>

</body>

</html>
