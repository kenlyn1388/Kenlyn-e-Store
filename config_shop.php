<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "shop_db";

if( !$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
die( "Failed to connect !" );
}

 
?>

