<?php
require_once "config.php";
session_start();
$id =$_GET['quiz_id'];  
$user =  $_SESSION['logged_in_id'];
$sql= "DELETE FROM surveys WHERE id  =  '".$id."' and owner_id = '".$user."'" ; 
$sql2= "DELETE FROM questions WHERE quiz_id  =  '".$id."'"; 
$sql3= "DELETE FROM answer_type WHERE quiz_id  =  '".$id."'" ; 
$sql4= "DELETE FROM answers WHERE quiz_id  =  '".$id."'" ; 

if(mysqli_query($link , $sql) && mysqli_query($link , $sql2) && mysqli_query($link , $sql3) && mysqli_query($link , $sql4)){
    $response = [
        'status'=>'ok',
        'success'=>true,
        'message'=>'Record deleted succesfully!'
    ];
    print_r(json_encode($response));
}else{
    $response = [
        'status'=>'ok',
        'success'=>false,
        'message'=>'Record deleted failed!'
    ];
    print_r(json_encode($response));
} 
location("header:surveys2.php")
?> 