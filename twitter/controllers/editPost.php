<?php
session_start();
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];
    $newContent = $_POST['content'];

    $sql = $connection->prepare("UPDATE Posts SET content = ?, updateDate = NOW() WHERE id = ?");
    $sql->bind_param("si", $newContent, $postId);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Post updated successfully.</p>';
    } else {
        echo '<p class="error">Error updating post. Please try again.</p>';
    }

    $sql->close();
    $connection->close();
}
?>

