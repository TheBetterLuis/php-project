<?php
include("../database.php");    
$sql = "SELECT * from users";
$result = $connection->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row['name'] . "<br>";
        echo "Last Name: " . $row['lastName'] . "<br><br>";
    }

} else {
    echo "Error: " . $connection->error;
}

$connection->close();


?>

<script type="text/javascript">
function Redirect(){
window.location="view_clients.php"
}
Redirect();
</script>

