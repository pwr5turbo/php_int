<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cijferapp";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $toetsen_query = $conn->prepare("SELECT * FROM `toetsen`;");
    $toetsen_query->execute();

    $toetsen_result = $toetsen_query->fetchAll();

    $toetsen = "<table>";
    $toetsen .= "<tr><th>Toets</th><th>Weging</th><th>delete</th><th>edit</th></tr>";
    foreach ($toetsen_result as $row) {
        $toetsen .= "<tr>";
        $toetsen .= "<td><a href=toetsen/toetsoverzicht.php?id=".$row["toets_id"].">" . $row['toetsnaam'] . "</a></td>";
        $toetsen .= "<td>" . $row['weging'] . '</td>';
        $toetsen .= "<td>" . '<a href="delete/toets.php?id=' . $row['toets_id'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' . '</td>';
        $toetsen .= "<td>" . '<a href="edit/toets.php?id=' . $row['toets_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>' . '</td>';
        $toetsen .= "</tr>";
    }
    $toetsen .= "</table>";

    $studenten_query = $conn->prepare("SELECT * FROM `studenten`;");
    $studenten_query->execute();

    $studenten_result = $studenten_query->fetchAll();

    $student = "<table>";
    $student .= "<tr><th>Student id</th><th>Voornaam</th><th>Achternaam</th><th>Login</th><th>Password</th><th>Delete</th><th>Edit</th></tr>";
    foreach ($studenten_result as $row) {
        $student .= "<tr>";
        $student .= "<td>" . $row['student_id'] . "</td>";
        $student .= "<td>" . $row['voornaam'] . '</td>';
        $student .= "<td>" . $row['achternaam'] . '</td>';
        $student .= "<td>" . $row['login'] . '</td>';
        $student .= "<td>" . $row['password'] . '</td>';
        $student .= "<td>" . '<a href="delete/student.php?id=' . $row['student_id'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' . '</td>';
        $student .= "<td>" . '<a href="edit/student.php?id=' . $row['student_id'] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>' . '</td>';
        $student .= "</tr>";
    }
    $student .= "</table>";

    if(isset($_POST['toetsnaam']) && isset($_POST['weging'])){
        $toetsnaam = $_POST['toetsnaam'];
        $weging = $_POST['weging'];
        $insert_toets_sql = "INSERT INTO `toetsen`(`toetsnaam`, `weging`) VALUES (:toetsnaam, :weging)";

        // zodat er geen sql code ingegooit kan worden
        $stmt = $conn->prepare($insert_toets_sql);
        $stmt->bindParam(':toetsnaam', $toetsnaam);
        $stmt->bindParam(':weging', $weging);
        
        if ($stmt->execute()) {
            echo "input succesful";
            // terug sturen naar zichzelf zodat die niet opnieuw instuurt als je herlaat
            header('Location: index.php');
            exit();
        }
    }
    if(isset($_POST['voornaam']) && isset($_POST['achternaam']) && $_POST['login']){
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $login = $_POST['login'];
        $password = "welkom123";

        $insert_leerling_sql = "INSERT INTO `studenten`(`voornaam`, `achternaam`, `login`, `password`) 
        VALUES (:voornaam, :achternaam, :login_inp, :password_inp)";

        // zodat er geen sql code ingegooit kan worden
        $stmt = $conn->prepare($insert_leerling_sql);
        $stmt->bindParam(':voornaam', $voornaam);
        $stmt->bindParam(':achternaam', $achternaam);
        $stmt->bindParam(':login_inp', $login);
        $stmt->bindParam(':password_inp', $password);
        
        if ($stmt->execute()) {
            echo "input succesful";
            // terug sturen naar zichzelf zodat die niet opnieuw instuurt als je herlaat
            header('Location: index.php');
            exit();
        }
    }

    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="docent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="docent.js"></script>
</head>
<body>
    
    <div>
        <button onclick="showT()">toetsen</button>
        <button onclick="showL()">leerlingen</button>
    </div>

    <div id="toetsen">
        <h1 onclick="show_toevoegToets()">toevoegen</h1>
        <?= $toetsen ?>
    </div>


    <div id="leerlingen">
        <h1 onclick="show_toevoegLeerling()">toevoegen</h1>
        <?= $student ?>
    </div>
    <div id="toevoegToets">
        <h1>toets toevoegen</h1>
        <form method="post">
            <table>
                <tr>
                    <td><label for="toetsnaam">Toetsnaam</label></td>
                    <td><input type="text" id="toetsnaam" name="toetsnaam" placeholder="toetsnaam"></td>
                </tr>
                <tr>
                    <td><label for="weging">Weging</label></td>
                    <td><input type="number" min="1" max="10" id="weging" name="weging" placeholder="weging" ></td>
                </tr>
                <tr>
                    <td colspan="2" ><input type="submit" value="Toevoegen"></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="toevoegLeerling">
        <h1>leerling toevoegen</h1>
        <form method="post">
            <table>
                <tr>
                    <td><label for="voornaam">Voornaam</label></td>
                    <td><input type="text" id="voornaam" name="voornaam" placeholder="voornaam"></td>
                </tr>
                <tr>
                    <td><label for="achternaam">Achternaam</label></td>
                    <td><input type="text" id="achternaam" name="achternaam" placeholder="achternaam"></td>
                </tr>
                <tr>
                    <td><label for="login">Login</label></td>
                    <td><input type="text" id="login" name="login" placeholder="login"></td>
                </tr>
                <tr>
                    <td colspan="2" ><input type="submit" value="Invoegen"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>