<?php

session_start();

session_unset();


$_SESSION['logged'] = false;

$_SESSION['user_name'] = "";

header('Location:logout.php');



?>