<?php
include('configDB.php');

$id_sala = $_POST["id_sala"];
$nome_sala = $_POST["nome_sala"];
$serie = $_POST["serie"];

$stmt->prepare("UPDATE salas SET nome_sala=?, serie=? WHERE id_sala=?");
$stmt->bind_param('ssi', $nome_sala, $serie, $id_sala);
$stmt->execute();