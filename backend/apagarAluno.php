<?php
include("configDB.php");

$id = $_GET['id'];

$stmt->prepare("DELETE FROM alunos WHERE id=?");

$stmt->bind_param("i", $id);

$stmt->execute();