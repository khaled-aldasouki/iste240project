<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
session_start();

if(isset( $_GET['quiz_id'])){
    $_SESSION['quiz_id'] = $_GET['quiz_id'];
}

// Process delete operation after confirmation
if(isset($_GET["new_name"]) && !empty($_GET["new_name"])){
    if(isset($_GET["new_name"]) && !empty($_GET["new_name"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a delete statement
    $sql = "UPDATE surveys SET name=? WHERE id=?";    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_name,$param_id);
        echo '<script> alert("'.$sql.'");</script>';
        // Set parameters
        $param_id = trim($_SESSION["quiz_id"]);
        $param_name = trim($_GET["new_name"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    
    mysqli_close($link);
    header("location: surveys.php");
    }

}
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Update Survey</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="assets/js/script.js"></script>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/media/icon.png" />
    </head>

    <body>
        
                <?php include 'nav.php'?>
        

        <main>
            <div class="heading">
                <h1>Update Survey Name</h1>
            </div>
            <div id="formdiv">
            <form id="updateform" onsubmit="return validateNewForm();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <br>
                <label for="new_name">Enter the new survey name:</label>
                <input type="text" id="survey-name" maxlength="30" name="new_name"  required></input>
            </form>
            <div id="button-div">
                <button class="button" type="submit" form="updateform">Submit</button>
            </div>
        </div>
 
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>