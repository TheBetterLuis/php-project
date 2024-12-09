<?php
session_start();
include("../timezone.php");
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postId = $_POST['post_id'];

    $sql = $connection->prepare("DELETE FROM Posts WHERE id = ?");
    $sql->bind_param("i", $postId);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Post deleted successfully.</p>';
    } else {
        echo '<p class="error">Error deleting post. Please try again.</p>';
    }
    $sql->close();
    $connection->close();
echo '<script>window.location.href=window.location.href</script>';
}
?>

