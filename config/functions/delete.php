<?php
// Connection and Helper
require_once '../connection.php';
require_once '../helper.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])){
    header("Location: ".BASE_URL);
    exit;
}
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && count($_POST) > 0){

    // Dataform
    $id         = trim($_REQUEST['id']);

    // Attempt delete query execution
    $sql = "DELETE FROM persons WHERE id = ".$id;
    
    if(mysqli_query($link, $sql)){
        echo "Records were deleted successfully";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        mysqli_close($link);
    }
     
    // Close connection
    mysqli_close($link);
   
} else {

    header("Location: ".BASE_URL, true, 400); // Bad Request
    exit;

}