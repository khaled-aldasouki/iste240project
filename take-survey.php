<?php
    session_start();
?>
<!DOCTYPE html>


<html>
    <head>
        <title>Take a Survey</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="../assets/css/style.css" rel="stylesheet">
        <script src="../assets/js/script.js"></script>
        <meta charset="utf-8" />
        <link rel="icon" href="../assets/media/icon.png" />
    </head>

    <body>
        
            <?php include 'nav.php'?>


        <main>
        <div id="formdiv">
            <form id="survey-form" 
 >
            <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM surveys WHERE id = ?";
                        
                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "i", $param_id);
                            
                            // Set parameters
                            $param_id = trim($_GET["id"]);
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                $result = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                                // Retrieve individual field value
                                $name = $row["name"];
                                
                            
                        } mysqli_free_result($result);
                        echo "<h1> $name </h1><br>";
                        $sql = "SELECT * FROM questions WHERE quiz_id = ?";
                        if($stmt = mysqli_prepare($link, $sql)){
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_id);
                            
                            // Set parameters
                            $param_id = trim($_GET["id"]);
                            
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                $result1 = mysqli_stmt_get_result($stmt);
                                while($row1= mysqli_fetch_array($result1)){
                                    // Retrieve individual field value
                                    $question = $row1["question"];
                                    $question_id = $row1["question_id"];
                                    echo "<label for='$question_id' id='question_id'>$question</label><br><br>";

                                    $sql2 = "SELECT * FROM answer_type WHERE quiz_id = ? and question_id = ?";
                                    if($stmt2 = mysqli_prepare($link, $sql2)){
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt2, "ss", $param_id,$param_question_id);
                                        
                                        // Set parameters
                                        $param_question_id = $question_id;

                                        // Attempt to execute the prepared statement
                                        if(mysqli_stmt_execute($stmt2)){
                                            $result2 = mysqli_stmt_get_result($stmt2);
                                            while($row2 = mysqli_fetch_array($result2)){
                                                $answer_type = $row2["answer_type"];
                                                $sql3 = "SELECT * FROM answers WHERE quiz_id = ? and question_id = ?";
                        
                                            if($stmt3 = mysqli_prepare($link, $sql3)){
                                                // Bind variables to the prepared statement as parameters
                                                mysqli_stmt_bind_param($stmt3, "ss", $param_id, $param_question_id);
                                                
                                                // Set parameters
                                                
                                                // Attempt to execute the prepared statement
                                                if(mysqli_stmt_execute($stmt3)){
                                                    $result3 = mysqli_stmt_get_result($stmt3);
                                                    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                                if ($answer_type == 'mc'){
                                                    echo '<div id="options">
                                                    <input type="radio" id="'.$question_id."option".'" name="'.$question_id.'options">
                                                    <label for='.$question_id.'>'.$row3["option_1"].'</label><br>
                                                    
                                                    <input type="radio" id="'.$question_id."option".'" name="'.$question_id.'options">
                                                    <label for='.$question_id.'>'.$row3["option_2"].'</label><br>

                                                    <input type="radio" id="'.$question_id."option".'" name="'.$question_id.'options">
                                                    <label for='.$question_id.'>'.$row3["option_3"].'</label><br>

                                                    <input type="radio" id="'.$question_id."option".'" name="'.$question_id.'options">
                                                    <label for='.$question_id.'>'.$row3["option_4"].'</label><br><br><br></div>';
                                                }
                                                else if ($answer_type == 'truefalse'){
                                                    echo '<div id="options">
                                                    <input type="radio" id="'.$question_id.'bool" name="'.$question_id.'">
                                                    <label for='.$question_id.'bool">True</label><br>
                                                    
                                                    <input type="radio" id="'.$question_id.'bool" name="'.$question_id.'">
                                                    <label for='.$question_id.'bool">False</label><br><br><br></div>';
                                                }
                                                else if ($answer_type == 'textarea'){
                        
                                                    echo '<textarea id="'.$question_id.'"textarea" name="'.$question_id.'"textarea">'.
                                                    $row3["text_box"].'</textarea><br><br>';

                                                    
                                                }}}
                        } 
                                }
                        }
                        
                    }
                                }
                        }
                        mysqli_free_result($result1);
                        mysqli_free_result($result2);
                        mysqli_free_result($result3);
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    echo '</form><div id="button-div">
                    <a class="nav-button" href="../index.php">Submit</a>
                    </div>'
                    
                    ?>

        </main>

        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>