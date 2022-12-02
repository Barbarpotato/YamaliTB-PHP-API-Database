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
    
    $stmt = $conn->prepare("INSERT INTO artikel(Tanggal, Waktu, Judul, Isi_1, Gambar_1, Isi_2, Gambar_2) VALUES(:tanggal, :waktu, :judul, :isi_1, :gambar_1, :isi_2, :gambar_2)");
    
    $stmt->bindParam(':tanggal', $user->tanggal);
    $stmt->bindParam(':waktu', $user->waktu);
    $stmt->bindParam(':judul', $user->judul);
    $stmt->bindParam(':isi_1', $user->isi_1);
    $stmt->bindParam(':gambar_1', $user->gambar_1);
    $stmt->bindParam(':isi_2', $user->isi_2);
    $stmt->bindParam(':gambar_2', $user->gambar_2);
    
    $stmt->execute();
    
    echo "New records created successfully";    

}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}
?>