<?php
session_start();
    unset($_SESSION["logged_in_name"]);
    unset($_SESSION["logged_in_id"]);
    header("location: index.php");
?>