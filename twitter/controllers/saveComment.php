<?php
session_start();
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];
    $commentContent = $_POST['content'];
    $userId = $_SESSION['user_id'];

    $sql = $connection->prepare("INSERT INTO Comments (post_id, user_id, content, creationDate) VALUES (?, ?, ?, NOW())");
    $sql->bind_param("iis", $postId, $userId, $commentContent);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Comment added successfully.</p>';
        echo '<script>window.history.back();</script>'; // Redirect to the previous page
        exit;
    } else {
        echo '<p class="error">Error adding comment. Please try again.</p>';
    }

    $sql->close();
    $connection->close();
}
?>

