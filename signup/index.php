<?php  
  // Connection and Helper
	require_once('../config/connection.php');
	require_once('../config/helper.php');

  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"])){
    header("Location: ".BASE_URL);
    exit;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" class="js-site-favicon" type="image/svg+xml" href="<?= BASE_URL.'assets/images/favicon.svg'; ?>">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="<?= BASE_URL.'libraries/bootstrap-4/css/bootstrap.min.css'; ?>">
    
    <!-- Font awesome 4 -->
    <link rel="stylesheet" href="<?= BASE_URL.'libraries/font-awesome-4/css/font-awesome.min.css'; ?>">
   
    <!-- MyStyle -->
    <link rel="stylesheet" href="<?= BASE_URL.'assets/css/mystyle.css'; ?>">
    
    <!-- Only this Page -->
    <link rel="stylesheet" href="<?= BASE_URL.'assets/css/authentication.css'; ?>">

    <title><?= 'phpnative. Framework - '.app('name_apps'); ?></title>
  </head>
  <body>

    <div class="row no-gutters">
      <div class="col-lg-4 no-gutters left d-flex justify-content-center align-items-center">
      <!-- Images Banner -->
      </div>
      <div class="col-lg-8 no-gutters right">
        <div class="h-100 row align-items-center no-gutters">
          <div class="col-10 offset-1 col-lg-8 offset-lg-2">
            
            <h4 class="mb-5"><a href="<?= BASE_URL; ?>" class="text-decoration-none text-dark"><kbd>phpnative.</kbd></a></h4>
            <p>Are you new here, Register Now<br>
            <span id="hiText">Please fill this form to create an account.</span></p>

            <form action="<?= BASE_URL.'config/functions/signup.php' ?>" method="POST">
              <hr class="mb-3">
              <?php
                $username = $email = NULL;
                if (isset($_SESSION['failSignUp'])) {
                    // Data form last input
                    $username = $_SESSION['dataForm']['username'];
                    $email    = $_SESSION['dataForm']['email'];
                    // Message errors
                    $msgErr = array_filter(explode('#', $_SESSION['failSignUp']));

                    echo '<div class="alert alert-danger fs-5" role="alert"><b>Failed: </b>';
                    if (count($msgErr) > 1){
                        echo '<ol class="mb-0">';
                        foreach ($msgErr as $key => $value) {
                            echo '<li>'.$value.'</li>';
                        }
                        echo '</ol>';
                    } else {
                        echo array_values($msgErr)[0];
                    }
                    echo '</div>';
                    
                    // Clear session 
                    unset($_SESSION['failSignUp']);
                    unset($_SESSION['dataForm']);
                }
             ?>
              <div class="form-row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="username" maxlength="15" class="form-control form-control-sm" id="inputUsername" aria-describedby="usernameHelp" value="<?= $username; ?>">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" id="inputEmail" value="<?= $email; ?>">
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" id="inputPassword">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputConfirmPassword">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control form-control-sm" id="inputConfirmPassword">
                  </div>
                </div>
              </div>
              <hr class="mt-2">
              <div class="text-right">
                <a href="<?= BASE_URL.'signin'; ?>" class="btn btn-link btn-sm text-decoration-none">Back to Sign In</a>
                <button type="submit" class="btn btn-success btn-sm" id="formSend">Register</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?= BASE_URL.'libraries/jquery-3/jquery-3.4.1.slim.min.js'; ?>"></script>
    <script src="<?= BASE_URL.'libraries/bootstrap-4/js/bootstrap.min.js'; ?>"></script>
    <script>
    $(document).ready(function() {
        console.log( "ready!" );
    });
    </script>
  </body>
</html>