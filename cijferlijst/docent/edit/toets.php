<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cijferapp";
if (isset($_POST['toetsnaam']) && isset($_POST['weging'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET["id"];

    // Check if form is submitted

        $toetsnaam = $_POST['toetsnaam'];
        $weging = $_POST['weging'];
        
        // Update the record in the database
        $sql = "UPDATE `toetsen` SET `toetsnaam`='$toetsnaam',`weging`='$weging' WHERE id=$id";
        $conn->exec($sql);
        echo "Record updated successfully";
    
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <div id="edit">
        <form method="post">
            <label for="toetsnaam">toetsnaam</label>
            <input type="text" name="toetsnaam" id="toetsnaam" placeholder="toetsnaam" required><br>
            <label for="weging">weging</label>
            <input type="text" name="weging" id="weging" placeholder="weging" required><br>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
