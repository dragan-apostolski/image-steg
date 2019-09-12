<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Login</title>

  <link href="<?= VENDOR_URL . "bootstrap/css/bootstrap.min.css"?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "simple-sidebar.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "home.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "login-styles.css" ?>" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 


</head>
<body>
    <div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
    <div id="login-wrapper">

    <?php if (!empty($errorMessage)): ?>
      <h2 class="important heading" style="color: red;"><?= $errorMessage ?></h2>
    <?php endif; ?>

    <?php if (empty($errorMessage)): ?>
      <h2 class="heading">Please log in on our page</h2>
    <?php endif; ?>
    <form id="login_form" method="POST" action="<?= BASE_URL . "login" ?>">
      <div id="login-container">
        <div class="login-item">
          <label for="username" class='info-paragraph'>Username</label> 
          <input type="text" class="btn btn-primary" name="username" autocomplete="off" required autofocus />
        </div>
        <div class="login-item">
          <label for="password" class='info-paragraph'>Password</label>
          <input type="password" class="btn btn-primary" name="password" required />
        </div>
        <button class="btn btn-primary btn-text">Log in</button>
      </div>
    </form>
    <br>
    <p class='info-paragraph'>Don't have an account? <a href="<?= BASE_URL . "register"?>">Sign up here.</a></p>
    </div>
    </div>
    </div>
</body>