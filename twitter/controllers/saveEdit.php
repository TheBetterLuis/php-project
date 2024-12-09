<?php
session_start();
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];
    $newContent = $_POST['content'];

    $sql = $connection->prepare("UPDATE Posts SET content = ?, updateDate = NOW() WHERE id = ? AND user_id = ?");
    $sql->bind_param("sii", $newContent, $postId, $_SESSION['user_id']);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Post updated successfully.</p>';
        echo '<script>window.location.href="../pages/profile.php"</script>';
    } else {
        echo '<p class="error">Error updating post. Please try again.</p>';
    }

    $sql->close();
    $connection->close();
}
?>

