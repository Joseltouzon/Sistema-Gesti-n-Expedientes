<?php

error_reporting(0);


include_once('conectionDB.php');

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}



// inicia la sesion
session_start();

if(!empty($_POST['destroy']) || !empty($_GET['destroy'])){
	session_destroy();
	header("Location: index.php");
}




?>