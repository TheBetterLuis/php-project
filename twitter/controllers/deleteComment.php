<?php
session_start();
include("../timezone.php");
include("../database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentId = $_POST['comment_id'];

    $sql = $connection->prepare("DELETE FROM Comments WHERE id = ?");
    $sql->bind_param("i", $commentId);

    if ($sql->execute() === TRUE) {
        echo '<p class="success">Comment deleted successfully.</p>';
    } else {
        echo '<p class="error">Error deleting comment. Please try again.</p>';
    }
    $sql->close();
    $connection->close();
    echo '<script>window.location.href=window.location.href</script>';
}
?>

