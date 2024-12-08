<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

function sendEmail($newUserEmail,$newUserName){
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='luismiguelromero3096@gmail.com';
// application password goes here, not the actual email password
$mail->Password='fliy exgj ufpu okqv';
$mail->SMTPSecure='ssl';
$mail->Port=465;

$mail->setFrom('luismiguelromero3096@gmail.com');
$mail->addAddress($newUserEmail);
$mail->isHTML(true);
$mail->Subject='Welcome to Our Website!';
$mail->Body='<!DOCTYPE html>
<html>
<head>
    <title>Welcome, '. $newUserName .'!</title>
</head>
<body>
    <h1>Welcome, '. $newUserName .'!</h1>
    <p>Thank you for registering.</p>
    <p>You can now access your account and start using our services.</p>
    <p>Best regards,</p>
    <p>The Website Team</p>
</body>
</html>';
$mail->send();
}


?>
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
sendEmail($email,$userName);
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
