<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "todolist";

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];

    $sql = "DELETE FROM taken WHERE id=$id";
    $conn ->query($sql);

    $conn->close();

    header("Location: todo.php");
?>
