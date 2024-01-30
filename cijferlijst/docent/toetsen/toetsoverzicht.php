<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cijferapp";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query
    $query = "SELECT `voornaam`, `achternaam`, `cijfer` FROM `resultaten`
              INNER JOIN studenten ON resultaten.student_id = studenten.student_id
              WHERE toets_id = :toets_id";

    // Use prepared statement
    $stmt = $conn->prepare($query);

    // Bind the parameter
    $toets_id = 1; // Change this to the desired toets_id
    $stmt->bindParam(':toets_id', $toets_id, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize the $table variable
    $table = "<table>";
    $table .= "<tr><th>Voornaam</th><th>Achternaam</th><th>Cijfer</th></tr>";
    foreach ($resultaten as $row) {
        $table .= "<tr>";
        $table .= "<td>" . $row['voornaam'] . "</td>";
        $table .= "<td>" . $row['achternaam'] . "</td>";
        $table .= "<td>" . $row['cijfer'] . "</td>";
        $table .= "</tr>";
    }
    $table .= "</table>";

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toets overzicht</title>
    <link rel="stylesheet" href="toetsoverzicht.css">
</head>
<body>
    <div id="toets_overzicht">
        <?= $table ?>
    </div>
</body>
</html>
