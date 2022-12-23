<?php

//! allowing all different resources coming in (for development only).
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$servername = "localhost";
$database = "database";
$username = "username";
$password = "password";

// Create connection using musqli_connect function
$conn = mysqli_connect($servername, $username, $password, $database);
// Connection Check
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
else{
$qu = 'SELECT * FROM sulsel';
$result = $conn->query($qu);

if($result->num_rows > 0){
    $cart = array();
    while($row = $result->fetch_assoc()) {
        $cart[] = (object) ['id' => $row['id'], 'tahun' => $row['tahun'], 'terdugaTb' => $row['terduga_tb'], 'kasusTb' => $row['kasus_tb'], 'sukses' => $row['sukses'], 'meninggal' => $row['meninggal'], 'defaul' => $row['defaul'], 'gagal' => $row['gagal']];
        
}
    header('Content-type: application/json');
    echo json_encode($cart);
    $conn->close();
}
else {
    echo $result;
}
}
?>