<?php
include("../database.php");

//start session
session_start();
if(!empty($_SESSION["id"])){
    header("Location: dashboard.php");
        exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
$mail = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
$password= $_POST["password"];

if(!$mail || empty($password)){
echo "Email or password invalid";
exit();
}

$sql = $connection->prepare("SELECT id,password FROM users WHERE mail = ?");
$sql->bind_param("s",$mail);
$sql->execute();
$sql->store_result();

if($sql->num_rows === 1){
$sql->bind_result($id,$hashedPassword);
$sql->fetch();
}

//verify password
if(password_verify($password,$hashedPassword)){
    //log in securely
    session_regenerate_id(true);
    $_SESSION["login"]=true;
    $_SESSION["id"]=$id;
    header("Location: dashboard.php");
    exit();
}else{
    echo "invalid password";
}
$sql->close();
}

//html goes below
?>
