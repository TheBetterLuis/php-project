<?php
function navGenerator($page=null){
    //since this gets generated to the pages that are located in pages folder, when linking the pages keep in mind they are in the same folder
    
    $returnValue = '<li><a href="dashboard.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../controllers/logOut.php">Log Out</a></li>';

    if($page === "login"){
$returnValue = '<li><a href="registration.php">Register</a></li>';
    }

    if($page === "registration"){
$returnValue = '<li><a href="login.php">Login</a></li>';
    }

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/nav-styles.css">
</head>
<body>
<div class="navbar">
        <div class="nav-brand">MyApp</div>
        <ul class="nav-links">'. $returnValue . '</ul>
</div>
</body>
</html>';

}
?>

