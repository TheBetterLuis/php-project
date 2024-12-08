<?php
session_start();
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];

    $sql = $connection->prepare("DELETE FROM Users WHERE id = ?");
    $sql->bind_param("i", $userId);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Account deleted successfully.</p>';
        session_destroy(); // End the session
    } else {
        echo '<p class="error">Error deleting account. Please try again.</p>';
    }

    $sql->close();
    $connection->close();
echo '<script>window.location.href="registration.php"</script>';
}
?>

