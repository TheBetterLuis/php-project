<link rel="stylesheet" href="../styles/dashboard.css">
<link rel="stylesheet" href="../styles/singleUserFeed.css">

<?php
if (session_status()== PHP_SESSION_NONE){
session_start();
}
include("../database.php");
$USERID = $_SESSION['user_id'];
    //$sql = $connection->prepare("SELECT * FROM Posts");
$sql = $connection->prepare("SELECT p.id, p.content, p.creationDate, u.username FROM Posts p INNER JOIN Users u ON p.user_id = u.id WHERE u.id = ? ORDER BY p.creationDate DESC");
    $sql->bind_param("i",$USERID);
if($sql->execute()){
$result = $sql->get_result();

    while ($row = $result->fetch_assoc()){
        $formattedDate = date('H:i d M Y', strtotime($row['creationDate']));
?>
    <div class="post">
        <div class="post-header">
            <span class="username"><?php echo $row['username']; ?></span>
        </div>
 <div class="post-content">
            <p><?php echo $row['content']; ?></p>
        </div>
<div class="post-footer">
               <div class="post-actions">
<?php
echo '<a href="viewPost.php?post_id=' . $row['id'] . '" class="comments">Comments&nbsp;&nbsp;</a>';
 if($row['username']=== $_SESSION['username']){
echo '<a href="editPost.php?post_id=' . $row['id'] . '" class="edit">Edit</a>';
echo '<span class="delete" data-post-id="'.$row['id'].'" >Delete</span>';
        } ?>
            </div>
<span class="timestamp"><?php echo '<br>'. $formattedDate; ?></span>
</div>
    </div>
    <?php
}
}else{
    echo "Error fetching posts..." . $sql->error;
}
$sql->close();

?>



