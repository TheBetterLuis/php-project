<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$userName = $_POST['username'];
	$email = $_POST['email'];
	$passcode= password_hash($_POST['password'],PASSWORD_DEFAULT);

include("../database.php");

try{

$sql = $connection->prepare("INSERT INTO Users (username,email,password,role,creationDate,updateDate) VALUES (?,?,?,'user',NOW(),NOW())");
$sql->bind_param("sss",$userName,$email,$passcode);
if($sql->execute()===TRUE){
echo '<p class="success">Registration successful!</p>';
}else{
	if($connection->errno == 1062){
	echo '<p class="error">Username or email already exists. Please try again :)</p>';
	}else{
	echo '<p class="error">Registration error :( Please try again later.</p>';
	}
}
}catch (mysqli_sql_exception $e){
	echo '<p class="error">Username or email already exists. Please try again :)</p>' . $e->getMessage();
 	error_log($e->getMessage()); // Log the error message to a file for debugging
}
$connection->close();
}
?>
