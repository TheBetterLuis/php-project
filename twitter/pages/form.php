<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<?php include("../components/nav.php");?>
    <div class="container">
        <h1>Registro de Clientes</h1>
        <form action="../controllers/process.php" method="post">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>  

            <label for="lastName">Apellido:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="birthDate">Fecha de Nacimiento:</label>
            <input type="date" id="birthDate" name="birthDate" required>

            <label for="city">Ciudad:</label>
            <input type="text" id="city" name="city" required>

            <label for="country">País:</label>
            <input type="text" id="country" name="country" required>  

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phoneCode">Código de Teléfono:</label>
            <select id="phoneCode" name="phoneCode">
                <option value="+58">+58 (Venezuela)</option>
                <option value="+1">+1 (US)</option>
                <option value="+44">+44 (UK)</option>
                <option value="+49">+49 (Alemania)</option>
                <option value="+34">+34 (España)</option>
                <option value="+39">+39 (Italia)</option>
                <option value="+81">+81 (Japón)</option>
                <option value="+82">+82 (Corea del Sur)</option>
                <option value="+86">+86 (China)</option>
                <option value="+7">+7 (Rusia)</option>
            </select>

            <label for="phone">Número de Teléfono:</label>
            <input type="tel" id="phone" name="phone" required>

            <input type="submit" value="Registrar">
        </form>
    </div>
</body>
</html>
