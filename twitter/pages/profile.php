<?php
session_start();
include("../timezone.php");
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

$(".delete").click(function(){
        var postId = $(this).data("post-id"); 
        if(confirm("Are you sure you want to delete this post? This action cannot be undone.")){
            $.post("../controllers/deletePost.php", { post_id: postId }, function(response){
                $(".message").html(response);
            });
        }
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
<?php echo '<h2>'. ucfirst($_SESSION['username']).', you can view your posts here</h2>'; ?>
<button id="deleteAccountButton">Erase Account</button>
<main>
<?php include("../components/newPostForm.php");?>
<?php include("../components/singleUserFeed.php");?>

</main>
<div class="message"></div>
</div>
</body>
<footer>
<?php include("../components/footer.php");?>    
</footer>
</div>
</html>


