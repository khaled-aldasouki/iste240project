<?php 
    if (isset($_SESSION['logged_in_name'])){
        $logged_in = $_SESSION['logged_in_name'];
    }
    
    echo '<header>';
    echo '<img class="logo" src="assets/media/logo.png">';
   
    echo '<img id="menu" src="assets/media/menu.png" onclick="showMenu();">';
    if (isset($logged_in)){
        echo '<h3> Welcome ' . $logged_in . '</h3>';
    }
    echo '<nav id="nav">';
        
        if (isset($logged_in)){
            echo '<a href="index.php" class="nav-button">Home</a>';
            echo '<a href="create.php" class="nav-button">Create</a>';
            echo '<a href="surveys.php" class="nav-button">Surveys</a>';
            echo '<a href="contact-us.php" class="nav-button">Contact Us</a>';
            echo '<a href="logout.php" class="nav-button">Logout</a>';
        }
        else{
            echo '<a href="index.php" class="nav-button">Home</a>';
            echo '<a href="contact-us.php" class="nav-button">Contact Us</a>';
            echo '<a href="login.php" class="nav-button">Login</a>';

        }
        
    echo '</nav>';
echo '</header>';
    


?>