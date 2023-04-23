<?php

session_start();
$name = trim($_SESSION["logged_in_name"]);
$id = trim($_SESSION["logged_in_id"]);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Surveys</title>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="assets/js/script.js"></script>
        <meta charset="utf-8" />
        <link rel="icon" href="assets/media/icon.png" />
    </head>

    <body>
        
                <?php include 'nav.php'?>
         
        <main>
            <div class="heading">
                <h1><?php echo $name ?>'s Surveys</h1>
            </div>
            <br>
            <div>
            <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM surveys WHERE owner_id = ?";
                    if($stmt = mysqli_prepare($link, $sql)){
                        

            // Bind variables to the prepared statement as parameters
                         mysqli_stmt_bind_param($stmt, 's', $param_id);
                         
                         // Set parameters
                        $param_id = $id;

                        if(mysqli_stmt_execute($stmt) > 0){
                            $result = mysqli_stmt_get_result($stmt);

                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<td>";
                                        echo "</td>";
                                    echo "</tr>";
                                    
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
            </div>

        </main>
        <footer>
            <p> Copyright &copy; 2023 Survey Masters All rights reservered</p>
        </footer>

    </body>
</html>