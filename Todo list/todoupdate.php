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

    $id = $_GET["id"];

    if(isset($_POST['einddatumanp']) && isset($_POST['taakanp'])){
        
        $taakanp = $_POST['taakanp'];
        $einddatumanp = $_POST['einddatumanp'];
    
        $einddatumanp = date("Y-m-d", strtotime($einddatumanp));
    
        $aanpastaak = "UPDATE `taken` 
        SET `taak`='$taakanp', `eindDatum`='$einddatumanp'  
        WHERE id='$id'";
    
        $conn->query($aanpastaak);
    
        $conn->close();

        header("Location: todo.php");
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aanpassen</title>
    <link rel="stylesheet" href="todo.css">
</head>
<body>
    <form method="post">
<div id="aanpassen_output">
        <h1 id="aanpassenheader"  onclick="hide()">Aanpassen</h1>
        <table id="aanpasTable">
            <tr>
                <td><label for="taakanp">Taak</label></td>
                <td><input type="text" id="taakanp" name="taakanp"></td>
            </tr>
            <tr>
                <td><label for="einddatumanp">Einddatum</label></td>
                <td><input type="date" id="einddatumanp" name="einddatumanp"></td>
            </tr>
        </table>
        <input type="submit" id="btn" value="Aanpassen">
    </div>
    </form>
</body>
</html>
