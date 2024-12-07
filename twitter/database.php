<?php
$servername = 'db';
$username = 'superuser';
$password ='1234';
$dbname ='twitter';

$connection = new mysqli($servername,$username,$password,$dbname);
if ($connection->connect_error) {
die("connection failed: " . $connection->connect_error);
}
//echo "connected successfully! :) <br>"
?>

