<?php
include("../database.php");

try{
$name = $_POST['name']; 
$lastName = $_POST['lastName']; 
$birthDate = $_POST['birthDate']; 
$city = $_POST['city']; 
$country = $_POST['country']; 
$email = $_POST['email']; 
$phoneCode = $_POST['phoneCode']; 
$phone = $_POST['phone'];

$stmt = $connection->prepare("INSERT INTO clients (name, lastName, birthDate, city, country, email, phoneCode, phone) VALUES (?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssss",$name,$lastName,$birthDate,$city,$country,$email,$phoneCode,$phone);
$stmt->execute(); 
 echo "Registro exitoso."; 
} catch (PDOException $e) { 
 echo "Error: " . $e->getMessage(); 
} finally { 
$connection = null; 
}
?>

<script type="text/javascript">
function Redirect(){
window.location="../pages/view_clients.php"
}
Redirect();
</script>

