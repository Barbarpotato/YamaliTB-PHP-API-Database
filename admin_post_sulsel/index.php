<?php

//! allowing all different resources coming in (for development only).
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$database = "database";
$username = "username";
$password = "password";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $user = json_decode(file_get_contents('php://input'));
    
    $stmt = $conn->prepare("INSERT INTO sulse(tahun, terduga_tb, kasus_tb, sukses, meninggal, defaul, gagal) VALUES(:tahun, :terduga_tb, :kasus_tb, :sukses, :meninggal, :defaul, :gagal)");
    
    $stmt->bindParam(':tahun', $user->tahun);
    $stmt->bindParam(':terduga_tb', $user->terdugaTb);
    $stmt->bindParam(':kasus_tb', $user->kasusTb);
    $stmt->bindParam(':sukses', $user->sukses);
    $stmt->bindParam(':meninggal', $user->meninggal);
    $stmt->bindParam(':defaul', $user->defaul);
    $stmt->bindParam(':gagal', $user->gagal);
    
    $stmt->execute();
    
    echo "New records created successfully";    

}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>