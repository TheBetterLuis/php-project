<?php
include("../database.php");    
$sql = "SELECT * FROM clients";
$result = $connection->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../styles/clients.css">
</head>
<body>
<?php include("../components/nav.php");?>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Ciudad</th>
                <th>País</th>
                <th>Email</th>
                <th>Código de Teléfono</th>
                <th>Número de Teléfono</th>
            </tr>
            <?php
            if ($result) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['lastName'] . "</td>";
                    echo "<td>" . $row['birthDate'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['country'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phoneCode'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Error: " . $connection->error . "</td></tr>";
            }
            $connection->close();
            ?>
        </table>
    </div>
</body>
</html>

