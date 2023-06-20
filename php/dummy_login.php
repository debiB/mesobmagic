<?php
session_start();
$_SESSION['uid'] = 2225;
$_SESSION['logged_in'] = "yes";
session_destroy();
?>;