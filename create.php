<?php

function insert_row($table,$value1,$value2,$value3,$link){
     // Check input errors before inserting in database

// Prepare an insert statement

    $sql = "INSERT INTO $table VALUES (?, ?, ?)";


    if($stmt = mysqli_prepare($link, $sql)){
                    // Set parameters
                    $param_val1_id = $value1;
                    $param_val2_id = $value2;
                    $param_val3_name = $value3;
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, 'sss', $param_val1_id, $param_val2_id , $param_val3_name);
        
        // Attempt to execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Records created successfully.  
    }

}


////////////////////////////////////////////////
function insert_answer($table,$value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$link){
    // Check input errors before inserting in database
    // Prepare an insert statement
        $sql = "INSERT INTO $table VALUES (?, ?, ?,?,?,?,?,?)";
    
        if($stmt = mysqli_prepare($link, $sql)){
                        // Set parameters
    
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'ssssssss', $value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8);
            
            // Attempt to execute the prepared statement
            mysqli_stmt_execute($stmt);
            // Records created successfully.  
        }
    }
    


//////////////////////////////////////////////
?>


<?php
require_once "config.php";
session_start();
// Include config file

// Define variables and initialize with empty values
 $survey_name = $answer_type = $text_box = $true_false = $option_1=$option_2=$option_3=$option_4= "";
 $quiz_id = $question_id = 0;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $skip = 0;
    

    foreach ($_POST as $key => $value){

        
        if ($skip > 0){
            $skip--;
            continue;
        }
        if ($key == "survey-name")
        {
            $quiz_id = uniqid();
            insert_row("surveys",$quiz_id,$_SESSION["logged_in_id"],$value,$link);
        }
        else if (strlen($key) == 2){
            $question_id = $key;
            insert_row("questions",$quiz_id,$question_id,$value,$link);
        }
        else if (substr($key,-4) == "type"){
            insert_row("answer_type",$quiz_id,$question_id,$value,$link);
        }
        if (substr($key,-5) == "bool1"){
            insert_answer("answers",$quiz_id,$question_id,null,"true",null,null,null,null,$link);
        }
        else {
            
            if (substr($key,-7,-1) == "option"){
                insert_answer("answers",$quiz_id,$question_id,null,null,$_POST[$question_id."option1"],$_POST[$question_id."option2"],$_POST[$question_id."option3"],$_POST[$question_id."option4"],$link);
                $skip = 3;
            }
            if (substr($key,-7) == "textbox"){
                insert_answer("answers",$quiz_id,$question_id,$value,null,null,null,null,null,$link);
            }
            
        }
        header("location: thank-you.php");
    }

}

mysqli_close($link);

?><!DOCTYPE html>

<html>
    <head>
        <title>Create a Survey</title>
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
                <h1>Create a survey</h1>
            </div>
            <div id="formdiv">
            <form id="newform" onsubmit="return validateNewForm();" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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