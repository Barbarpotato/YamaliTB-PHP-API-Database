<?php

//! allowing all different resources coming in (for development only).
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$dbname = "database";
$username = "username";
$password = "password";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $user = json_decode(file_get_contents('php://input'));
    
    $stmt = $conn->prepare("INSERT INTO kasus(tahun, semester, kabupaten, terduga_tb, kasus_tb, berhasil, meninggal, defaul, gagal) VALUES(:tahun, :semester, :kabupaten, :terduga_tb, :kasus_tb, :berhasil, :meninggal, :defaul, :gagal)");
    
    $stmt->bindParam(':tahun', $user->tahun);
    $stmt->bindParam(':semester', $user->semester);
    $stmt->bindParam(':kabupaten', $user->kabupaten);
    $stmt->bindParam(':terduga_tb', $user->terduga_tb);
    $stmt->bindParam(':kasus_tb', $user->kasus_tb);
    $stmt->bindParam(':berhasil', $user->berhasil);
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