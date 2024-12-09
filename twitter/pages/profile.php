<?php
session_start();
if(!isset($_SESSION['user_id'])){
echo '<script>window.location.href="login.php"</script>';
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
<link rel="stylesheet" href="../styles/dashboard.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){

    $("#deleteAccountButton").click(function(){
if(confirm("Are you sure you want to delete your account? This action cannot be undone.")){
    $.post("../controllers/eraseAccount.php",{user_id: <?php echo $_SESSION['user_id'];?>},function(response){
$(".message").html(response);
})
}
});

    $("#postButton").click(function(){
    event.preventDefault();
    var formData = $("#new-post-form").serialize();
    $.post("../controllers/newPost.php",formData, function(response){
    $(".message").html(response);
});
});



});

</script>

</head>
<div class="page">
<nav>
<?php include("../components/nav.php"); navGenerator();?>    
</nav>
<body>
<div class="container">
<button id="deleteAccountButton">Erase Account</button>
<?php include("../components/newPostForm.php");?>
<main>
<?php include("../components/placeholder.php");?>    
</main>
<div class="message"></div>
</div>
</body>
<footer>
<?php include("../components/footer.php");?>    
</footer>
</div>
</html>


