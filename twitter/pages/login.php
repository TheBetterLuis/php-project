<?php
session_start();
include("../timezone.php");
if(isset($_SESSION['user_id'])){
echo '<script>window.location.href="dashboard.php"</script>';
 exit;
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
    $("#login").click(function(){
    event.preventDefault();
    var formData = $("#loginForm").serialize();
    $.post("../controllers/loginProcess.php",formData, function(response){
    $(".message").html(response);
});
});
});
</script>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/login.css">
</head>
<div class="page">
<nav>
<?php include("../components/nav.php"); navGenerator("login");?>    
</nav>
<body>
<div class="container">
    <h2>Sign In</h2>
    <form id="loginForm">
        <label for="username">Username or Email</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <button id="login" type="submit">Sign In</button>
    </form>
    <div class="message">
    </div>
</div>
</body>
<footer>
<?php include("../components/footer.php");?>    
</footer>
</div>
</html>

