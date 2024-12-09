<?php
session_start();
include("../database.php");

if(!isset($_SESSION['user_id'])){
echo '<script>window.location.href="login.php"</script>';
 exit;
}

if (!isset($_GET['post_id'])) {
    echo "No post ID specified.";
    exit;
}

$postId = $_GET['post_id'];

$sql = $connection->prepare("SELECT content FROM Posts WHERE id = ? AND user_id = ?");
$sql->bind_param("ii", $postId, $_SESSION['user_id']);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Post not found or you do not have permission to edit this post.";
    exit;
}

$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<div class="page"><nav>
<?php include("../components/nav.php"); navGenerator();?>    
</nav>
<body>
<div class="container">

<div class="edit-post-container">
    <h1>Edit Post</h1>
    <form method="POST" action="../controllers/saveEdit.php">
        <textarea id="post-content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <button id="postButton" type="submit">Save Changes</button>
    </form>
    <div class="message"></div>
</div>
</div>
</body>
<footer>
<?php include("../components/footer.php");?>    
</footer>
</div>
</html>

<?php
$sql->close();
$connection->close();
?>

<style>
/* Assuming you have a container for the edit post form */
.edit-post-container {
    padding: 20px;
    border-radius: 5px;
}

/* Form elements */
.edit-post-form {
    display: flex;
    flex-direction: column;
}

.edit-post-form textarea {
    width: 100%;
    height: 150px;
    background-color: #fff;
    color: #222;
    border: 1px solid #c82448;
    border-radius: 5px;
    padding: 10px;
    resize: vertical;
}

.edit-post-form button {
    background-color: #c82448;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}
.post-div{
    background-color: #333;
    padding: 20px;
    border-radius: 5px;
}

#post-content {
    width: 100%;
    height: 100px;
    background-color: #333;
    color: #fff;
    border: 1px solid #c82448;
    border-radius: 5px;
    padding: 5px;
    resize: vertical;
		font-size: x-large;
}

#postButton {
    background-color: #c82448;
    color: #fff;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}
</style>


