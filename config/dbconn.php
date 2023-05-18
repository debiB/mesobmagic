<?php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'Amanuel');
define('DB_PASS', 'passaman');
define('DB_NAME', 'mesobmagic');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error){
    die('Connection Failed' . $conn->error);
}
else{
}
?>