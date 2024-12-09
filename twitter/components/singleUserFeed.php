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
 <div class="post-content">
            <p><?php echo $row['content']; ?></p>
        </div>
        <div class="post-header">
            <span class="username"><?php echo $row['username']; ?></span>
            <span class="timestamp"><?php echo '<br>'. $formattedDate; ?></span>
        </div>
               <div class="post-actions">
            </div>
    </div>
    <?php
}
}else{
    echo "Error fetching posts..." . $sql->error;
}
$sql->close();
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
</style>
