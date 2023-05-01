<?php
session_start();
// Process delete operation after confirmation
if(isset($_GET["quiz_id"]) && !empty($_GET["quiz_id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM surveys WHERE id = ? and owner_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_id,$param_owner_id);
        
        // Set parameters
        $param_id = trim($_GET["quiz_id"]);
        $param_owner_id = trim($_SESSION["logged_in_id"]);
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    $sql2 = "DELETE FROM questions WHERE quiz_id = ?";
    
    if($stmt2 = mysqli_prepare($link, $sql2)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt2, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["quiz_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt2)){
            // Records deleted successfully. Redirect to landing page
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $sql3 = "DELETE FROM answer_type WHERE quiz_id = ?";
    
    if($stmt3 = mysqli_prepare($link, $sql3)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt3, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["quiz_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt3)){
            // Records deleted successfully. Redirect to landing page
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $sql4 = "DELETE FROM answers WHERE quiz_id = ?";
    
    if($stmt4 = mysqli_prepare($link, $sql4)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt4, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["quiz_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt4)){
            // Records deleted successfully. Redirect to landing page
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close connection
    mysqli_close($link);
    header("location: surveys.php");

} else{
    // Check existence of id parameter
    if(empty(trim($_GET["quiz_id"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>