<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "shopping";

if( !$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
die( "Failed to connect !" );
}


?>