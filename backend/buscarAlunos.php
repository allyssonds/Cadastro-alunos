<?php
include('configDB.php');

$result = $mysqli->query("SELECT * FROM `alunos` INNER JOIN salas on alunos.id_sala = salas.id_sala ", MYSQLI_USE_RESULT);

$returnVar = array();

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $returnVar[] = $row;
}

echo json_encode($returnVar);