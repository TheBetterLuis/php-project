<?php

include("../database.php");
    //$sql = $connection->prepare("SELECT * FROM Posts");
$sql = $connection->prepare("SELECT p.id, p.content, p.creationDate, p.updateDate, u.username FROM Posts p INNER JOIN Users u ON p.user_id = u.id ORDER BY p.creationDate DESC");
    $sql->execute();
    $result = $sql->get_result();

    while ($row = $result->fetch_assoc()){
        $formattedDate = date('H:i d M Y', strtotime($row['creationDate']));
?>
<link rel="stylesheet" href="../styles/postsFeed.css">
    <div class="post">
        <div class="post-header">
            <span class="username"><?php echo $row['username']; ?></span>
        </div>
 <div class="post-content">
            <p><?php echo $row['content']; ?></p>
        </div>
<div class="post-footer">
               <div class="post-actions">
<span class="comments">Comments</span>
<?php if($row['username']=== $_SESSION['username']){
echo '<a href="editPost.php?post_id=' . $row['id'] . '" class="edit">Edit</a>';
echo '<span class="delete" data-post-id="'.$row['id'].'" >Delete</span>';
        } ?>
            </div>
<span class="timestamp"><?php echo '<br>'. $formattedDate; ?></span>
</div>
    </div>
    <?php
}
?>


