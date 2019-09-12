<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Register</title>

  <link href="<?= VENDOR_URL . "bootstrap/css/bootstrap.min.css"?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "simple-sidebar.css" ?>" type="text/css" rel="stylesheet">
  <link href="<?= CSS_URL . "login-styles.css" ?>" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 

</head>
<body>
    <div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
    <div id="login-wrapper">

    <?php if (!empty($errorMessage)): ?>
      <h2 class="important heading" style="color: red;"><?= $errorMessage ?></h3>
    <?php endif; ?>

    <?php if (empty($errorMessage)): ?>
      <h2 class='heading'>Create a new account here</h3>
    <?php endif; ?>

    <form id="login_form" method="POST" action="<?= BASE_URL . "register" ?>">
      <div id="login-container">
        <div class="login-item">
          <label for="username" class='info-paragraph'>Username</label> 
          <input type="text" class="btn btn-primary" name="username" autocomplete="off" required autofocus />
        </div>
        <div class="login-item">
          <label for="password" class='info-paragraph'>Password</label>
          <input type="password" class="btn btn-primary" name="password" required />
        </div>
        <button class="btn btn-primary btn-text">Create account</button>
      </div>
    </form>
    <br>
    <p class='info-paragraph'>Already have an account? <a href="<?= BASE_URL . "login"?>">Log in here.</a></p>
    </div>
    </div>
    </div>
</body>