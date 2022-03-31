<?php
header('Content-type: application/json');

include('configDB.php');

$result = $mysqli->query("SELECT * FROM salas", MYSQLI_USE_RESULT);

$returnVar = array();

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $returnVar[] = $row;
}

echo json_encode($returnVar);