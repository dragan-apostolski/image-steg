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
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 

</head>

<body>

<div class="d-flex" id="wrapper">

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
                    <a class="nav-link btn-text" href="<?= BASE_URL . "home"?>">Steganize<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn-text" href="<?= BASE_URL . "gallery"?>">Gallery</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn-text" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      
        <div id="container-file-drop">
            <h2 class="heading">Give us your image here</h2>
            <p class="info-paragraph-header">The selected image is the file in which you can encode your messages.<br>
              After selecting the image, you can encode the messages you want in the image.
            </p>
            <br>
            <div id="drop-zone">
                <p class='info-paragraph'>Drop your image here.</p>
            </div>
            <div id="browse-zone">
                <p class='info-paragraph'>Or select an image from your file system.</p>
                <label for="file-upload" class="btn btn-primary label-text">
                <i class="fa fa-cloud-upload"></i>Choose File
                </label>
                <input id="file-upload" type="file" accept="image/png, image/jpeg" onchange="handleFileSelect(this)"/>
            </div>
        </div>

        <div id='steg-container-wrapper'>
          <h2 class="heading">Steganize your image here</h2>
            <div id='steg-container'>
              <div id="image-info-holder">
                <p id="image-name" class="info-paragraph"></p>
                <img id="image-container">
                <br>
                <div class="download-save-container">
                    <a id="download-anchor" class="btn btn-primary btn-text" rel="nofollow">Download image</a>
                    <button id="save-button" class="btn btn-primary btn-text" 
                        onclick="btnSaveToGalClick()">Save to gallery</button> 
                </div>
              </div>
              <div id="messages">    
                <div id="encoding-form">
                    <p class="info-paragraph">Add message</p>
                    <br>
                    <input type="text" id="message-title" 
                        placeholder="Title (optional)" class="btn btn-primary message-title">
                    <br>
                    <textarea id='message-text' class="btn btn-primary message-box" 
                                        placeholder="Enter your secret message here"></textarea>
                    <br>
                    <button class="btn btn-primary btn-text" id='btnEncode' onclick="onBtnEncodeClick()">Encode</button> 
                </div>

                <div id="messages-container">
                    <p class="info-paragraph">View/edit messages</p>
                    <br>
                    <select id="message-select" class="btn btn-primary message-title"></select>
                    <input hidden="true" type="text" id="message-title-edit" class="btn btn-primary message-title">
                    <br>
                    <textarea id="message-view" readonly class="btn btn-primary message-box"></textarea>
                    <br>
                    <button class="btn btn-primary btn-text" id='btnEdit' onclick="onBtnEditClick()">Edit</button>
                    <div id="cancel-update-cont">
                        <button class="btn btn-primary btn-text" id='btnUpdate' onclick="onBtnUpdateClick()">Update</button> 
                        <button class="btn btn-primary btn-text" id='btnCancel' onclick="onBtnCancelClick()">Cancel</button> 
                    </div>
                </div>
              </div>
            </div>
            <div id="progress-bar-wrapper" class="progress">
                <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-success" role="progressbar"
                    aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            <p class='info-paragraph'><em>This progress bar shows how much space in the image is used for encoding data.</em></p> 
        </div>
    </div>
</div>

<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Operation successful</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-body" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form method="GET" action="<?= BASE_URL . "gallery" ?>">
          <input type="submit" value="Go to gallery" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Message not updated</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-body-error" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
          let img = "<?php echo $_SESSION["edit_image"]["image_data"];?>";
          $("#steg-container-wrapper").css("display", "flex");
          $("#image-name").text(imageName);
          $('html, body').animate({
            scrollTop: $("#steg-container-wrapper").offset().top}, 1000);
          afterEncodingRituals(messages, img);
        <?php endif; ?>
    });

    function btnSaveToGalClick(){
      img = document.getElementById("image-container").src;
      url = "<?= BASE_URL . "gallery/add"?>";
      <?php if (isset($_SESSION["edit_image"])): ?>
        url = "<?= BASE_URL . "gallery/update" ?>";
      <?php endif; ?>
      usedCapacity = document.getElementById("progress-bar").style.width;
      $.post(
            url,
            {image: img, imageName: imageName, 
              messages: JSON.stringify(messages), usedCapacity: usedCapacity},
            function(response){
                 if(response == 1){
                    if (url == "<?= BASE_URL . "gallery/add"?>"){
                      document.getElementById("modal-body").innerText = 
                        "Image succesfully added to gallery.";
                      $("#info-modal").modal("show");
                   }
                   else{
                      document.getElementById("modal-body").innerText = 
                        "Image changes saved to gallery.";
                      $("#info-modal").modal("show");
                   }
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
