<?php
$DB_HOST =  '127.0.0.1';
$DB_USER = 'Amanuel';
$DB_PASS = 'passaman';
$DB_NAME = 'mesobmagic';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error){
    die('Connection Failed' . $conn->error);
}
else{
    // echo "Connected";
}
?>