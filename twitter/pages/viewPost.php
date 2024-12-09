<?php
session_start();
include("../database.php");

if (!isset($_GET['post_id'])) {
    echo "No post ID specified.";
    exit;
}

$postId = $_GET['post_id'];

$sql = $connection->prepare("SELECT p.content, u.username FROM Posts p INNER JOIN Users u ON p.user_id = u.id WHERE p.id = ?");
$sql->bind_param("i", $postId);
$sql->execute();
$result = $sql->get_result();

if ($result->num_rows !== 1) {
    echo "Post not found.";
    exit;
}

$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Comment</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<div class="page">
<nav>
    <?php include("../components/nav.php"); navGenerator();?>    
</nav>
<body>
<div class="container">

<div class="comment-post-container">
<h1>Post by <?php  echo htmlspecialchars($post['username']);?></h1>
    <div class="post-content">
        <p class="post-text"><?php echo htmlspecialchars($post['content']); ?></p>
    </div>

    <h1>Add Comment</h1>
    <form method="POST" action="../controllers/saveComment.php">
        <textarea id="comment-content" name="content" placeholder="Write a comment..." required></textarea>
        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
        <button id="commentButton" type="submit">Submit Comment</button>
    </form>
    <div class="message"></div>

 <h2>Comments</h2> 
<div class="comments"> 
<?php
$commentSql = $connection->prepare("SELECT c.content, c.creationDate, u.username FROM Comments c INNER JOIN Users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.creationDate DESC");
$commentSql->bind_param("i", $postId); $commentSql->execute();
$commentResult = $commentSql->get_result(); 

if ($commentResult->num_rows > 0) { 
    while ($commentRow = $commentResult->fetch_assoc()) {
        $commentDate = date('H:i d M Y', strtotime($commentRow['creationDate'])); echo '<div class="comment">';
        echo '<span class="username"> Comment by ' . htmlspecialchars($commentRow['username']) . '</span>'; 
        echo '<span class="timestamp"><br> ' . $commentDate . '</span>';
        echo '<p class="content">  ' . htmlspecialchars($commentRow['content']) . '</p>'; 
        echo '</div>';
    } } else {
    echo '<p>No comments yet. Be the first to comment!</p>'; } $commentSql->close();
?>

</div>
</div>
</body>
</div>
<footer>
    <?php include("../components/footer.php");?>    
</footer>

</html>

<?php
$sql->close();
$connection->close();
?>

<style>
#comment-content{
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
.username,.timestamp{
    color: #888;
}
.content{
font-size: large;
margin-top: 4px;
}
.post-text{
font-size: x-large;
}

</style>
