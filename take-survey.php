
    <?php
    session_start();
// Check existence of id parameter before processing further
if(isset($_GET["id"])){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM surveys WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>


<html>
    <head>
        <title>Take a Survey</title>
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
                <h1><?php echo $name; ?></h1>
            </div>
            <div id="formdiv">
            <form id="newform" onsubmit="return validateNewForm();">
                <label class='question' for="survey-name">Survey Name:</label>
                <br>
                <input type="text" id="survey-name" maxlength="30" name="survey-name" placeholder='Enter the survey name...' required></input>
                <label class='question' for="q1">Question 1:</label>
                <br>
                <textarea id="q1" name="q1" placeholder='Enter the question here...' required></textarea>
                <br>
                <label for="q1type">Question 1 type:</label>
                <br>
                <select required name="q1type" id="q1type" onchange="changetype(1);" >
                    <option value="none" selected disabled hidden>Select an Option</option>
                    <option value="textarea">Text Box</option>
                    <option value="truefalse">True/False</option>
                    <option value="mc">Multiple Choice</option>
                </select>
                <br>
                <div id="options1">
                </div>
            </form>
            <div id="button-div">
                <button class="button" onclick="addquestion();">Add question</button>
                <button class="button" type="submit" form="newform">Submit</button>
            </div>
        </div>
 
        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>