<?php
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 0);
session_start();

$_SESSION['uid'] = 20;
header("Location: postRecepie.php")
?>
