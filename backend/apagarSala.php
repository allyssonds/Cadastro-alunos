<?php
include("configDB.php");

$id_sala = $_GET['id_sala'];

$stmt->prepare("DELETE FROM salas WHERE id_sala = ?");
$stmt->bind_param('i',$id_sala);
$stmt->execute();