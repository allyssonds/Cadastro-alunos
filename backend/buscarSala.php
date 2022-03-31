<?php 
header('Content-type: application/json');

include('configDB.php');

$id = $_POST['id_sala'];

$stmt->prepare("SELECT * FROM salas WHERE id_sala=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$returnVar = array();
while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $returnVar[] = $row;
};

echo json_encode($returnVar);