<?php
$servername = 'db';
$username = 'sqlsetup';
$password ='strongPassword';
$dbname ='sqlsetup';

$connection = new mysqli($servername,$username,$password,$dbname);
if ($connection->connect_error) {
die("connection failed: " . $connection->connect_error);
}
echo "connected successfully! :) <br>"
?>

