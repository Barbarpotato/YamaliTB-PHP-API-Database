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
$qu = 'SELECT * FROM artikel';
$result = $conn->query($qu);

if($result->num_rows > 0){
    $cart = array();
    while($row = $result->fetch_assoc()) {
        $isi_1 = iconv("UTF-8","UTF-8//IGNORE",$row["Isi_1"]);
        $isi_2 = iconv("UTF-8","UTF-8//IGNORE",$row["Isi_2"]);
        $cart[] = (object) ['id' => $row['Id'], 'tanggal' => $row['Tanggal'], 'waktu' => $row['Waktu'], 'judul' => $row['Judul'], 'isi_1' => $isi_1, 'gambar_1' => $row['Gambar_1'], 'isi_2' => $isi_2, 'gambar_2' => $row['Gambar_2']];
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