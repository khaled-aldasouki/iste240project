<?php
session_start();

// Check existence of id parameter before processing further

    // Include config file
    require_once "config.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["email"]) && isset($_POST["password"])){
            // Prepare a select statement
            $sql = "SELECT * FROM users WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_email = trim($_POST["email"]);
                $password = trim($_POST["password"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
            
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($password == $row["password"]){
                            $_SESSION["logged_in_name"] = $row["name"];
                            $_SESSION["logged_in_id"] = $row["id"];
                            header("location: surveys.php");
                        }
                        // Retrieve individual field value
                        else{
                            // URL doesn't contain valid id parameter. Redirect to error page
                            echo "<script> alert('Error: login verification failed'); window.location.href='login.php';</script>";
                            exit();
                        }
                    } 
                    else{
                        // URL doesn't contain valid id parameter. Redirect to error page
                        echo "<script> alert('Error: login verification failed'); window.location.href='login.php';</script>";
                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
}
}
    // Close connection
    mysqli_close($link);

?>
<!DOCTYPE html>

<html>
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="assets/js/script.js"></script>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/media/icon.png" />
    </head>

    <body>
        
            <?php include 'nav.php'?>


        <main>
            <div id="login-form-div">
            <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Login</h2>
                <label for="email">Email:</label><br>
                <input type="email" name='email' id="email" required><br>
                <br>
                <label for="password">Password: </label><br>
                <input type="password" name='password' id="password" required><br>
                <button class="button" type="submit">Login</button><br>
                <a id="signuplink" href="signup.php">Don't have an account? Sign up</a>

            </form>
        </div>
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>