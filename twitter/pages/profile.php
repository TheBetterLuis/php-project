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
    $("#button").click(function(){
    $("#test").load("rng.php");
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
<?php
echo '
<div id="test">
<p>here comes the numbers</p>
</div>'
;
?>
<button id="button">click to change</button>

<main>
<?php include("../components/placeholder.php");?>    
</main>

</div>
</body>
<footer>
<?php include("../components/footer.php");?>    
</footer>
</div>
</html>


