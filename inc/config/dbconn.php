<?php
$DB_HOST =  '10.4.115.50';
$DB_USER = 'mesob';
$DB_PASS = 'password';
$DB_NAME = 'mesobmagic';
$port = 3307;

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $port);
if ($conn->connect_error){
    die('Connection Failed' . $conn->error);
}
else{
    // echo "Connected";
}

// $DB_HOST =  '127.0.0.1';
// $DB_USER = 'Amanuel';
// $DB_PASS = 'password';
// $DB_NAME = 'mesobmagic';
// $port = 3306;

// $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// if ($conn->connect_error){
//     die('Connection Failed' . $conn->error);
// }
// else{
//     // echo "Connected";
// }

?>