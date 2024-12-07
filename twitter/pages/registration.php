<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
    $("#registration").click(function(){
    event.preventDefault();
    var formData = $("#registerForm").serialize();
    $.post("../controllers/registrationProcess.php",formData, function(response){
    $(".message").html(response);
});
});
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/registration.css">
</head>
<div class="page">
<nav>
<?php include("../components/nav.php"); navGenerator("registration");?> 
</nav>
<body>
<div class="container">
    <h2>Registration</h2>
 <form id="registerForm">
 <label for="username">Username</label>
 <input type="text" id="username" name="username" required>
 <label for="email">Email</label> 
<input type="email" id="email" name="email" required>
 <label for="password">Password</label>
 <input type="password" id="password" name="password" required>
 <button id="registration" type="submit">Register</button> 
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

