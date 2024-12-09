<?php
session_start();
include("../timezone.php");
include("../database.php");

if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href="login.php"</script>';
    exit;
}

if (!isset($_GET['username'])) {
    echo "No username specified.";
    exit;
}

$profileUsername = $_GET['username'];

// Fetch profile user data
$userSql = $connection->prepare("SELECT id, username FROM Users WHERE username = ?");
$userSql->bind_param("s", $profileUsername);
$userSql->execute();
$userResult = $userSql->get_result();

if ($userResult->num_rows !== 1) {
    echo "User not found.";
    exit;
}

$profileUser = $userResult->fetch_assoc();
$profileUserId = isset($profileUser['id']) ? $profileUser['id'] : null;
$loggedInUsername = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($profileUser['username']); ?>'s Profile</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function(){

    $("#deleteAccountButton").click(function(){
if(confirm("Are you sure you want to delete your account? This action cannot be undone.")){
    $.post("../controllers/eraseAccount.php",{user_id: <?php echo $_SESSION['user_id'];?>},function(response){
$(".message").html(response);
})
}
});
    $("#postButton").click(function(){
    event.preventDefault();
    var formData = $("#new-post-form").serialize();
    $.post("../controllers/newPost.php",formData, function(response){
    $(".message").html(response);
});
});

$(".delete").click(function(){
        var postId = $(this).data("post-id"); 
        if(confirm("Are you sure you want to delete this post? This action cannot be undone.")){
            $.post("../controllers/deletePost.php", { post_id: postId }, function(response){
                $(".message").html(response);
            });
        }
    });


    });
    </script>
</head>
<div class="page">
<nav>
    <?php include("../components/nav.php"); navGenerator(); ?>    
</nav>
<body>
<div class="container">
    <h2><?php echo ucfirst($profileUser['username']); ?>'s Profile</h2>
    <?php if ($profileUserId === $loggedInUserId) { ?>
    <button id="deleteAccountButton">Erase Account</button>
    <?php } ?>
    <main>
        <?php
        if ($profileUserId === $loggedInUserId) {
            include("../components/newPostForm.php");
        } ?>

        <div class="posts">
            <?php
            $postSql = $connection->prepare("SELECT id, content, creationDate FROM Posts WHERE user_id = ? ORDER BY creationDate DESC");
            $postSql->bind_param("i", $profileUserId);
            $postSql->execute();
            $postResult = $postSql->get_result();

            if ($postResult->num_rows > 0) {
                while ($postRow = $postResult->fetch_assoc()) {
                    $postDate = date('H:i d M Y', strtotime($postRow['creationDate']));
                    echo '<div class="post">';
                    echo '<p>' . htmlspecialchars($postRow['content']) . '</p>';
                    echo '<span class="timestamp">' . $postDate . '</span>';
                    if ($profileUserId === $loggedInUserId) {
                        echo '<button class="delete" data-post-id="' . $postRow['id'] . '">Delete</button>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No posts yet.</p>';
            }
            $postSql->close();
            ?>
        </div>
    </main>
    <div class="message"></div>
</div>
</body>
<footer>
    <?php include("../components/footer.php"); ?>    
</footer>
</div>
</html>

<?php
$connection->close();
?>

<style>
.post {
    border-bottom: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
}

.post-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
        justify-content: space-between;
}

.post-header .username {
    font-weight: bold;
    font-size: 1.2em;
    margin-right: 10px;
}

.post-header .timestamp {
    font-size: 0.8em;
    color: #888;
}

.post-content {
    margin-bottom: 10px;
}

.post-footer {
    font-size: 0.8em;
    color: #888;
    display: flex;
    align-items: center;
        justify-content: space-between;
}

.post-actions {
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin: 10px 0;
    color: #c82448;
}

.post-actions span {
    margin: 0 10px;
}

.comments {
    color: #c82448;
}

.comments:hover, .edit:hover, .delete:hover {
    cursor: pointer;
    color: #fff;
}

a {
    color: inherit;
    text-decoration: none;
    cursor: default;
}
</style>

