<?php

$connx = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATA, DB_USER, DB_PASSWORD);


function getDBConnection() {
	require_once(__DIR__.'/../../config.php');
    $connx = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_DATA, DB_USER, DB_PASSWORD);
    
    return $connx;
}

function closeDBConnection() {
    global $connx;
    $connx = null;
}


?>