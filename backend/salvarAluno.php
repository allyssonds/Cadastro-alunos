<?php
include('configDB.php');

$nome = $_POST["nome"];
$idade = $_POST["idade"];
$cpf = $_POST["cpf"];
$id_sala = $_POST["id_sala"];

// prepara a query sql
$stmt->prepare("INSERT INTO alunos(nome,idade,cpf,id_sala) values(?,?,?,?)");

$stmt->bind_param("siii", $nome, $idade, $cpf, $id_sala);

$stmt->execute();