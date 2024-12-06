<style>
body{
background-color: #333;
color:#fff;
}
</style>
<body>
<?php
//SECTION 3 php

$data = "hello, this is a hash example in php";
$hash = hash("sha256",$data);

//let's print the hash
echo "Data: $data <br>";
echo "Hash256: $hash <br>";

//password example 
$originalPassword = "Secured123";


//let's generate hash for password
$hashPassword = password_hash($originalPassword,PASSWORD_DEFAULT);
echo "originalPassword: $originalPassword <br>";
echo "originalPassword: $hashPassword <br>";
//let's simulate a session login with a password entered by the user
$enteredPassword = "Secured12";
if(password_verify($enteredPassword,$hashPassword)){
echo "valid password <br>";
}else{
echo "incorrect password<br>";
}

// ISSET
// to verify if a variable is defined or null

//define variables
$myVar = "Hello, i'm a variable";
$myVar2 = "Hello, i'm a variable";

//can use multiple parameters to check all variables
if(isset($myVar,$myVar3)){
    echo "variable exists<br>";
}else{
    echo "variable doesn't exist<br>";
}

// COOKIES
// got error about cannot modify headers here
//setcookie("kek","Luis",time()+60,"/");
if (isset($_COOKIE["user"])){
    $userName = $_COOKIE["user"];
    echo "<br> Hello, $username"; 
}else{
    echo "<br> Hello, this is the first time you visit us";
}

//setcookie("kek","newValue",time()+60,"/");
//erase cookie
//setcookie("kek","",time()-3600,"/");


// global variables

//$_GET
//URL : example.php?name-Jose&Age=21
//get data
$name = $_GET["name"]??"";
$age= $_GET["age"]??"";

echo "<br> Name: $name <br>";
echo "<br> Age: $age <br>";

//$_POST
//form <form action="example.php" method-"post"></form>
$user = $_POST["user"]??"";

//$_COOKIE
$recover = $_COOKIE["user"];

// $_SESSION
//start session
session_start();

// lets establish a session variable
$_SESSION["user"]="Pedrito";

//get session
echo "hello, ". $_SESSION["user"] . "<br>";

//finalize session
$_SESSION= [];
session_unset();
session_destroy();
//to redirect
//header("Location: index.php");

// $_SERVER contains information about server and script execution
// obtain server name
echo $_SERVER["SERVER_NAME"]. "<br>";
echo $_SERVER["SERVER_ADDR"]. "<br>";
echo $_SERVER["REMOTE_ADDR"]. "<br>";

//obtain http method
echo $_SERVER["REQUEST_METHOD"]. "<br>";
//obtain url
// it's uri in REQUEST_URI
echo $_SERVER["REQUEST_URI"]. "<br>";
echo $_SERVER["SERVER_PROTOCOL"]. "<br>";
echo $_SERVER["DOCUMENT_ROOT"]. "<br>";

if(isset($_SERVER["HTTPS"])){
    echo "connection is secure";
}else {
    echo "connection isn't secure";
}

echo $_SERVER["SERVER_PROTOCOL"];

//$_ENV contains variables regarding environment server
$_ENV["secret"]="12345";
echo "<br>".$_ENV["secret"];

//REGEX
//--- preg_match
$string = "hello my number is 123-456-3023";
if(preg_match("/\b\d{3}-\d{3}-\d{4}\b/",$string)){
  echo "<br>match found";
}else{
  echo "<br>no match found";
};

// --preg_replace to replace pattern
$string = "hello i am luis  45";
$newString = preg_replace("/\d{2}/","30",$string);
echo "<br>". $newString . "<br>";


// --preg_split to replace pattern
$string = "apples,oranges,grapes";
$fruits = preg_split("/,/",$string);
print_r($fruits);
?>
</body>
