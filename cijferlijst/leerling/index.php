<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cijferapp";

    $id = $_GET['id'];

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT `cijfer` , `toetsnaam` FROM `resultaten` INNER JOIN toetsen ON resultaten.toets_id = toetsen.toets_id WHERE student_id=$id;");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $table = "<table>";
    $table .= "<tr><th>cijfer</th><th>toetsnaam</th></tr>";
    foreach($result as $row){
        $table .= "<tr>";
        $table .= "<td>". $row['cijfer'] . "</td>";
        $table .= "<td>" . $row['toetsnaam'] . "</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";

    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }
    $conn = null;
    echo "</table>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cijfers wiskunde</title>
    <link rel="stylesheet" href="leerling.css">
</head>
<body>
    <div id="cijfers">
        <?= $table ?>
    </div>
</body>
</html>