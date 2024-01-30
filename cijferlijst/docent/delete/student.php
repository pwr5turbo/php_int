<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cijferapp";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET["id"];

    $sql = "DELETE FROM studenten WHERE student_id= $id";

    $conn->exec($sql);
    echo "Record deleted successfully";
    } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

    header("Location: ../index.php");
    exit();
?>