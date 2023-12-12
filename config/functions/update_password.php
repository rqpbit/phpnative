<?php  
	// Connection and Helper
	require_once '../helper.php';

	// Check if the user is already logged in, if yes then redirect him to welcome page
  if(!isset($_SESSION["loggedin"])){
		header("Location: ".BASE_URL.'login.php');
		exit;
	}

	// Define variables and initialize with empty values
	$password_lama = $password_baru = "";
	$username_lama_err = $password_baru_err = "";

	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0){
	 
	    // Check if password old is empty
	    if(empty(trim($_REQUEST["password_lama"]))){
	        $username_err = "Please enter old password.";
	    } else{
	        $password_lama = trim($_REQUEST["password_lama"]);
	    }

	    // Check if password new is empty
	    if(empty(trim($_REQUEST["password_baru"]))){
	        $username_err = "Please enter new password.";
	    } else{
	        $password_baru = trim($_REQUEST["password_baru"]);
	    }
	    

	    // Validate username
	    if(empty($username_err) && empty($password_err)){
	        // Prepare a select statement
	        $sql = "SELECT password FROM pengguna WHERE username = ?";
	        
	        if($stmt = mysqli_prepare($link, $sql)){
	            // Bind variables to the prepared statement as parameters
	            mysqli_stmt_bind_param($stmt, "s", $param_username);
	            
	            // Set parameters
	            $param_username = $_SESSION['username'];
	            
	            // Attempt to execute the prepared statement
	            if(mysqli_stmt_execute($stmt)){
	                // Store result
	                mysqli_stmt_store_result($stmt);
	                
	                // Check if username exists, if yes then verify password
	                if(mysqli_stmt_num_rows($stmt) == 1){                    
	                    // Bind result variables
	                    mysqli_stmt_bind_result($stmt, $my_password_old);
	                    if(mysqli_stmt_fetch($stmt)){
	                        if(password_verify($password_lama, $my_password_old)){

	                        		// Update new password
									            $sql = "UPDATE pengguna SET password = ?, tgl_diubah = NOW() WHERE username = ?";
									             
									            if($stmt = mysqli_prepare($link, $sql)){
									                // Bind variables to the prepared statement as parameters
									                mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
									                
									                // Set parameters
									                $param_password = password_hash($password_baru, PASSWORD_DEFAULT); // Creates a password hash
									                
									                // Attempt to execute the prepared statement
									                if(mysqli_stmt_execute($stmt)){
									                    // Redirect to login page
									            				$_SESSION['password-updated'] = true;
									                    header("Location: ".BASE_URL.'views/akun.php');
									                } else{
									                    echo "Something went wrong. Please try again later.";
									                }
									    
									                // Close statement
									                mysqli_stmt_close($stmt);
									            }
	                            
	                        } else {
									            $_SESSION['password-failed'] = true;
									            header("Location: ".BASE_URL.'views/akun.php');

	                            // Display an error message if password is not valid
	                            // $password_err = "The password you entered was not valid.";
	                        }
	                    }
	                } else {
	                    // Display an error message if username doesn't exist
	                    $username_err = "No account found with that username.";
	                }
	            } else {
	                echo "Oops! Something went wrong. Please try again later or contact Administrator.";
	            }

	            // Close statement
	            mysqli_stmt_close($stmt);
	        }
	    }

	    // Response
	    // if (!empty($username_err) || !empty($password_err)) {
	    // 	$msg_err = $password_err.$username_err; // only 1 variable assign
	    // 	$_SESSION['failSignIn'] = [$msg_err, $_REQUEST['username']];
	    // 	header('Location: '.BASE_URL.'login.php');
	    // }
	    
	    // Close connection
	    mysqli_close($link);
	} else {
      header("Location: ".BASE_URL.'login.php', true, 400); // Bad Request
      exit;
  }
