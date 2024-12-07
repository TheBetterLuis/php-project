<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../styles/registration.css">
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

