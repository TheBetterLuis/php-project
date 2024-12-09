<?php

include("../database.php");
    //$sql = $connection->prepare("SELECT * FROM Posts");
$sql = $connection->prepare("SELECT p.id, p.content, p.creationDate, p.updateDate, u.username FROM Posts p INNER JOIN Users u ON p.user_id = u.id ORDER BY p.creationDate DESC");
    $sql->execute();
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
<span class="comments">Comments</span>
<?php if($row['username']=== $_SESSION['username']){
echo '<span class="edit">Edit</span>
<span class="delete">Delete</span>';
        } ?>
            </div>
<span class="timestamp"><?php echo '<br>'. $formattedDate; ?></span>
</div>
    </div>
    <?php
}
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

.post-footer{
    font-size: 0.8em;
    color: #888;
    display: flex;
    align-items: center;
		justify-content: space-between;
}
.post-actions{
	display: flex;
	align-items: center;
	justify-content: space-evenly;
margin:10px 0;
color:#c82448;
}
.post-actions span{
margin: 0 10px;
}
.comments{
color:#c82448;
}
.comments:hover,.edit:hover,.delete:hover{
cursor: pointer;
    color: #fff;
}

</style>
