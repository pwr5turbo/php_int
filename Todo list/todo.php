<?php 
$table = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['taakinp']) && isset($_POST['einddatuminp'])){
    $taakinp = $_POST['taakinp'];
    $einddatuminp = $_POST['einddatuminp'];

    $einddatuminp = date("Y-m-d", strtotime($einddatuminp));

    $inserttaak = "INSERT INTO `taken`(`id`, `taak`, `eindDatum`) 
    VALUES (NULL, '$taakinp', '$einddatuminp')";

    if ($conn->query($inserttaak) === TRUE) {
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$query = "SELECT * FROM `taken`";
$result = $conn->query($query);

$i = 0;

$table .= "<table id='sqlTable'>";
$table .= "<tr><th>Taken</th><th>Eind datum</th><th>Aanpassen</th><th>Klaar</th></tr>";
while ($row = $result->fetch_assoc()) {
    $today = date("Y-m-d");
    $deleteLink = "todotrash.php?id=" . $row["id"];
    $aanpasLink = "todoupdate.php?id=" . $row["id"];

    $class = ($row["eindDatum"] < $today) ? 'expired' : '';

    $table .= '<tr id="row' . $i . '">';
    $table .= '<td>' . $row["taak"] . '</td>';
    $table .= '<td class="' . $class . '">' . $row["eindDatum"] . '</td>';
    $table .= '<td><div class="aanpassen_btn"><a href="' . $aanpasLink . '">Edit<a></div></td>';
    $table .= '<td><a href="' . $deleteLink . '"><i style="color:white;" class="fa fa-check-circle-o"></i></a></td></tr>';

    $i++;
}
$table .= "</table>";

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="todo.js"></script>
    <title>Todo list</title>
</head>
<body>
    <div id="header">
    <div><H1>Todo list</H1></div>
    <div id="toevoegen" onclick="toevoegen()">Voeg een taak toe</div>
    </div>
    <div id="table">
    <?php echo $table; ?>
    </div>

    <div id="toevoegen_output">
        <h1 onclick="hide()" id="toevoegheader">Toevoegen</h1>
        <form method="post">       
            <table id="toevoegTable">
                <tr>
                    <td>
                    <label for="taak">taak</label>
                    </td>
                    <td>
                    <input type="text" id="taakinp" name="taakinp">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="datum">Eind datum</label>
                    </td>
                    <td>
                    <input type="date" id="einddatuminp" name="einddatuminp">
                    </td>
                </tr>
            </table>
            <input type="submit" value="Toevoegen" id="btn">
        </form>
    </div>
</body>
</html>