<?php
session_start();

include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    $sql = $connection->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");
    $sql->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("location: ../pages/dashboard.php");
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No account found with that username or email.";
    }

    $sql->close();
    $connection->close();
}
?>
