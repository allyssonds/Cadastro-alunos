<?php 
include("configDB.php");

$nome_sala = $_POST["nome_sala"];
$serie = $_POST["serie"];

$stmt->prepare("INSERT INTO salas(nome_sala,serie) values(?,?)");
$stmt->bind_param('ss',$nome_sala,$serie);
$stmt->execute();