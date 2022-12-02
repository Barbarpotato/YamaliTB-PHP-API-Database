<?php

//! allowing all different resources coming in (for development only).
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$database = "database";
$username = "username";
$password = "password";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user = json_decode(file_get_contents('php://input'));
$id= $user->id;
$tahun = $user->tahun;
$semester = $user->semester;
$kabupaten = $user->kabupaten;
$terduga = $user->terduga_tb;
$kasus = $user->kasus_tb;
$berhasil = $user->berhasil;
$meninggal = $user->meninggal;
$defaul = $user->defaul;
$gagal = $user->gagal;

$sql = "UPDATE kasus SET tahun=$tahun, semester=$semester, kabupaten=$kabupaten, terduga=$terduga,
        kasus=$kasus, berhasil=$berhasil, meninggal=$meninggal, defaul=$defaul, gagal=$gagal WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>