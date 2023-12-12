<?php
// Connection and Helper
require_once '../connection.php';
require_once '../helper.php';

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0){

    // Prepare a select statement (Checking username is exist)
    $sql = "SELECT id FROM users WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = trim($_REQUEST["username"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            /* store result */
            mysqli_stmt_store_result($stmt);
            $findAccount = false;

            if(mysqli_stmt_num_rows($stmt) == 1){
                $resetPassword = generateRandomString();
                $findAccount   = true;
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if ($findAccount)
    { 
        // Prepare an insert statement
        $sql = "UPDATE users SET password = ? WHERE username = ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
            
            // Set parameters
            $param_password = password_hash($resetPassword, PASSWORD_DEFAULT); // Security with password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo $resetPassword; exit;
            } else{
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
            }
        } else{
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
    
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
   
    // Close connection
    mysqli_close($link);

    echo "nofind";

} else {

    header("Location: ".BASE_URL, true, 400); // Bad Request
    exit;
    
}