<?php
session_start();
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$id = $name = $email = $password = $confirm_password= "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $id = uniqid();

    $input_name = trim($_POST["name"]);
    
    $name = $input_name;
    
    $input_email = trim($_POST["email"]);
    
    $email = $input_email;
    
    $input_password = trim($_POST["password"]);
    $input_confirm_password = trim($_POST["confirm_password"]);
    if ($input_confirm_password != $input_password){
        echo "<script> alert('Error: password verification failed'); window.location.href='signup.php';</script>";
        exit();
    }
    else{
        $password = $input_password;
    }

    
    
    
    // Check input errors before inserting in database
    
        // Prepare an insert statement
        $sql = "INSERT INTO users (id, name, email, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
                        // Set parameters
                        $param_id = $id;
                        $param_name = $name;
                        $param_email = $email;
                        $param_password = $password;
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'ssss', $param_id, $param_name, $param_email, $param_password);
            

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);

?>
<!DOCTYPE html>

<html>
    <head>
        <title>Sign up</title>
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
                <h2>Sign up</h2>
                <label for="name">Name:</label><br>
                <input type="text" id="name" name='name' required maxlength="20" value="<?php echo $name; ?>"><br>
                <br>
                <label for="email">Email:</label><br>
                <input type="email" id="email" name='email' maxlength="100"required  value="<?php echo $email; ?>"><br>
                <br>
                <label for="password">Password: </label><br>
                <input type="password" id="password" name='password' required maxlength="20"  value="<?php echo $password; ?>"><br>
                <br>
                <label for="confirm-password">Confirm Password: </label><br>
                <input type="password" id="confirm-password" name='confirm_password' required maxlength="20"><br>
                <button class="button" value="Submit"  type="submit">Sign up</button><br>
                <a id="signuplink" href="login.php">Already have an account? Login</a>

            </form>
        </div>
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>