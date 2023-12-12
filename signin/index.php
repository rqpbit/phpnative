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
            <p>Welcome back,<br>
            <span id="hiText">Please sign in to your account.</span></p>
            <p>No account? <a href="<?= BASE_URL.'signup'; ?>" class="text-decoration-none text-success">Sign up now</a></p>
            
            <form action="<?= BASE_URL.'config/functions/signin.php' ?>" method="POST">
              <hr class="mb-3">
              <?php  
              $username = NULL;
              // Message for error for sign in
              if (isset($_SESSION['failSignIn'])) {
                $username = $_SESSION['failSignIn'][1];
                echo '<div class="alert alert-danger fs-5" role="alert"><b>Failed: </b>'.$_SESSION['failSignIn'][0].'</div>';
                unset($_SESSION['failSignIn']);
              }
              // Message for success from register
              if (isset($_SESSION['registered'])) {
                echo '<div class="alert alert-warning fs-5" role="alert"><b>Success: </b> Your account has been created, '.$_SESSION['registered'].' please fill your password to Dashboard.</div>';
                unset($_SESSION['registered']);
              }
              ?>

              <div class="form-row" id="formSignIn">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <input type="text" name="username" maxlength="15" class="form-control form-control-sm" id="inputUsername" aria-describedby="usernameHelp" value="<?= $username; ?>">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" name="password" class="form-control form-control-sm" id="inputPassword">
                  </div>
                </div>
              </div>
              <div class="form-row" id="formRecover" style="display: none;">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="inputUsernameRecover">Username</label>
                    <input type="text" name="usernameRecover" maxlength="15" class="form-control form-control-sm" id="inputUsernameRecover" aria-describedby="usernameRecoverHelp">
                    <small id="usernameRecoverHelp" class="form-text text-muted mb-0">Don’t worry! Just fill in your username and we’ll reset your password, you will get new password with popup alert.</small>
                  </div>
                </div>
              </div>
              <hr class="mt-2">
              <div class="text-right">
                <button type="button" class="btn btn-link btn-sm text-decoration-none" id="changeForm" form='recover'>Recover Password</button>
                <button type="submit" class="btn btn-primary btn-sm" id="formSend" target="signin">Login to Dashboard</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?= BASE_URL.'libraries/jquery-3/jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?= BASE_URL.'libraries/bootstrap-4/js/bootstrap.min.js'; ?>"></script>
    <script>
    $(document).ready(function() {
        console.log( "ready!" );
        $('#changeForm').click(function(){
          var form = $(this).attr('form');

          if (form == 'recover') {
            $('#hiText').text('Request for reset password.');
            $('#formSignIn').hide(); $('#formRecover').show();
            $('#formSend').text('Reset my password').removeClass('btn-primary').addClass('btn-success').attr('target', 'recover');
            $('#inputUsername, #inputPassword').val('');
            $('.alert-danger ').hide();

            $(this).text('Back to Sign In').attr('form', 'signin');
          } else if (form == 'signin') {
            $('#hiText').text('Please sign in to your account.');
            $('#inputUsernameRecover').val('');
            $('#formRecover').hide(); $('#formSignIn').show();
            $('#formSend').text('Login to Dashboard').removeClass('btn-success').addClass('btn-primary').attr('target', 'signin');
            $(this).text('Recover Password').attr('form', 'recover');
          }
        });

        // Submit form
        $('#formSend').click(function(e){
          if ($(this).attr('target') == 'recover'){
            e.preventDefault();
            $.post("<?= BASE_URL.'config/functions/reset_password.php'; ?>",
            {
              username: $('#inputUsernameRecover').val()
            },
            function(response){
              if(response != 'nofind') {
                alert("SUCCESS: Your password has been reset : " + response);
              } else {
                alert("ERROR: Invalid username!")
              }
            });
          }
        });

        // My password for automatically signin (default)
        $("#inputUsername").keyup(function(){
          if ($('#inputUsername').val() == 'rqpbit') {
            $('#inputPassword').val('hny2021');
          } else {
            $('#inputPassword').val('');
          }
        });

        // Warning for reset my password (rqpbit)
        $("#inputUsernameRecover").keyup(function(){
          if ($('#inputUsernameRecover').val() == 'rqpbit') {
            alert('If you want reset this account, please retype new password for signin later.');
          }
        });
    });
    </script>
  </body>
</html>
