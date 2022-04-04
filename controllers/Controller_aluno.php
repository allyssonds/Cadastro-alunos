<?php

header('Content-type: application/json');

include('../models/Aluno.php');

$url = $_SERVER['REQUEST_URI'];

// criar aluno
if($url == "/cadastroalunosobjetos/controllers/Controller_aluno.php/salvarAluno"){
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $cpf = $_POST['cpf'];
    $id_sala = $_POST['id_sala'];
    $aluno->salvarAluno($nome,$idade,$cpf,$id_sala);
}

// apagar aluno
if($url == "/cadastroalunosobjetos/controllers/Controller_aluno.php/apagarAluno"){
    $id = $_POST['id'];
    $aluno->apagarAluno($id);
}

// buscar lista de alunos
if($url == "/cadastroalunosobjetos/controllers/Controller_aluno.php/buscarAlunos"){
    echo json_encode($aluno->buscarAlunos());
}

// atualizar aluno
if($url == "/cadastroalunosobjetos/controllers/Controller_aluno.php/updateAluno"){
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $cpf = $_POST['cpf'];
    $id = $_POST['id'];
    $id_sala = $_POST['id_sala'];
    $aluno->updateAluno($id,$nome,$idade,$cpf,$id_sala);
}

// buscar um aluno
if($url == "/cadastroalunosobjetos/controllers/Controller_aluno.php/buscarAluno"){
    $id = $_POST['id'];
    echo $aluno->buscarAluno($id);
}