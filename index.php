<?php

session_start();

$_SESSION['logged'] = false;

$_SESSION['user_name'] = "";

header('Location:main.php');



?>