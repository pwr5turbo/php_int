<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cijferapp";
if (isset($_POST['voornaam']) && isset($_POST['achternaam']) && isset($_POST['login']) && isset($_POST['password'])){
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET["id"];

    // Check if form is submitted

        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Update the record in the database
        $sql = "UPDATE `studenten` SET `voornaam`='$voornaam', `achternaam`='$achternaam', `login`='$login', `password`='$password' WHERE student_id = $id";
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
            <label for="voornaam">Voornaam</label>
            <input type="text" name="voornaam" id="voornaam" placeholder="voornaam" required><br>
            <label for="achternaam">Achternaam</label>
            <input type="text" name="achternaam" id="achternaam" placeholder="Achternaam" required><br>
            <label for="login">Login</label>
            <input type="text" name="login" id="login" placeholder="Login" required><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
