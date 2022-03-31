<?php
include('configDB.php');

$id = $_POST["id"];
$nome = $_POST["nome"];
$idade = $_POST["idade"];
$cpf = $_POST["cpf"];
$id_sala = $_POST["id_sala"];

$stmt->prepare("UPDATE alunos SET nome=?, idade=?, cpf=?, id_sala=? WHERE id=?");
$stmt->bind_param('siiii', $nome, $idade, $cpf, $id_sala, $id);
$stmt->execute();