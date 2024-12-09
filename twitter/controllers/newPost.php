<?php
session_start();
include("../timezone.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $userId = $_SESSION['user_id'];
    $postContent = $_POST['post-content'];

include("../database.php");

try{

$sql = $connection->prepare("INSERT INTO Posts (user_id,content,creationDate,updateDate) VALUES (?,?,NOW(),NOW())");
$sql->bind_param("is",$userId,$postContent);

if($sql->execute()===TRUE){
echo '<p class="success">Post created successfully!</p>';
}else{
	echo '<p class="error">Error creating post. Please try again.</p>';
}
}catch (mysqli_sql_exception $e){
	echo '<p class="error">Database error. Please try again later.</p>' . $e->getMessage();
 	error_log($e->getMessage()); // Log the error message to a file for debugging
}
$connection->close();
}
echo "<script>window.location.href=window.location.href</script>";
?>
