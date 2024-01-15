<?php
$conn =  new mysqli('localhost', 'root', '', 'top2000'); 
if ($conn->connect_error) {     	                     
    die("Connection failed: " . $conn->connect_error);
}

if(!empty($_GET['find']) && is_numeric($_GET['find'])) {
    $sql = 'SELECT * FROM `artist` WHERE `id` ="'.$_GET['find'].'"';
}
elseif(!empty($_GET['find']) && $_GET['find'] == 'all') {
    $sql = "SELECT * FROM `artist`";
}

///// creating array with result
if(!empty($sql))    {  
    $result = $conn->query($sql);
    
    $collection=[];
    if ($result->num_rows > 0)
    {
        while($row=$result->fetch_assoc()){
            $collection[]=(object)$row;      // create an array with a numeric row-keys and row-data for each row
        }
    }
}
else {
    $collection = ['title'=>'My API-server'];
}

$out = array_merge(['meta' =>['count'=>count($collection)]],['data' =>$collection]);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($out, JSON_PRETTY_PRINT);
	die;f


?>