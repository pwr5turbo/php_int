<?php
    if(isset($_POST['inlogD']) || isset($_POST['password_D']))
    {//inloggen docent check database
        $inlogD = $_POST['inlogD'];
        $password_D = $_POST['password_D'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cijferapp";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT login_D, wachtwoord FROM `docent` WHERE login_D = :loginD AND wachtwoord = :wachtwoord_D");
            $stmt->bindParam(':loginD', $inlogD);
            $stmt->bindParam(':wachtwoord_D', $password_D);
            
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Login successful, the combination exists in the database
                echo "Login successful";
            } else {
                // Login failed, the combination does not exist in the database
                echo "Login failed";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        header("location: docent/index.php?");
    }
    
    elseif (isset($_POST['inlogL']) || isset($_POST['password_L']))
    {//inloggen leerling check database
        $inlogL = $_POST['inlogL'];
        $password_L = $_POST['password_L'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cijferapp";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT student_id, login, password FROM `studenten` WHERE login = :loginL AND password = :wachtwoord_L");
            $stmt->bindParam(':loginL', $inlogL);
            $stmt->bindParam(':wachtwoord_L', $password_L);
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Login successful, the combination exists in the database
                echo "Login successful";
                $leerlingID = $result['student_id'];
            } else {
                // Login failed, the combination does not exist in the database
                echo "Login failed";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        header("Location: leerling/index.php?id=$leerlingID");
    }
    
    else{
        //formulier invullen
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <div id="docentInlog">
            <h1>Docent Inlog</h1>
            <table>
                <form method="post">
                    <tr>
                        <td><label for="inlog">Inlog docent</label></td>
                        <td><input type="text" id="inlogD" name="inlogD" placeholder="Inlog docent" ></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="text" id="password_D" name="password_D" placeholder="Password"  ></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Inloggen Docent"></td>
                    </tr>
                </form>
            </table>
        </div>
        
        <div id="leerlingInlog">
            <h1>Leerling inlog</h1>
            <table>
                <form method="post">
                    <tr>
                        <td><label for="inlog">Inlog leerling</label></td>
                        <td><input type="text" id="inlogL" name="inlogL" placeholder="Inlog leerling" ></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password</label></td>
                        <td><input type="text" id="password_L" name="password_L" placeholder="Password"  ></td>
                    </tr>
                    <tr>
                    <td><input type="submit" value="Inloggen leerling"></td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    
</body>
</html>