<?php

//! allowing all different resources coming in (for development only).
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$database = "database";
$username = "username";
$password = "password";

$conn = mysqli_connect($servername, $username, $password, $dbname);  
if(!$conn){  
    die('Could not connect: '.mysqli_connect_error());  
}  
echo 'Connected successfully';  

$user = json_decode(file_get_contents('php://input'));
$id= $user->id;  
$sql = "DELETE from berita where Id=$id";  
if(mysqli_query($conn, $sql)){  
    echo "Record deleted successfully";  
}else{  
    echo "Could not deleted record: ". mysqli_error($conn);  
}  
mysqli_close($conn);  
?>