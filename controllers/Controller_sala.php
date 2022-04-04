<?php
header('Content-type: application/json');

include('../models/Sala.php');

$url = $_SERVER['REQUEST_URI'];

// criar sala
if($url == "/cadastroalunosobjetos/controllers/Controller_sala.php/salvarSala"){
    $nome_sala = $_POST['nome_sala'];
    $serie = $_POST['serie'];
    $sala->salvarSala($nome_sala,$serie);
}

// apagar sala
if($url == "/cadastroalunosobjetos/controllers/Controller_sala.php/apagarSala"){
    $id_sala = $_POST['id_sala'];
    $sala->apagarSala($id_sala);
}

// buscar lista de salas
if($url == "/cadastroalunosobjetos/controllers/Controller_sala.php/buscarSalas"){
    echo json_encode($sala->buscarSalas());
}

// atualizar sala
if($url == "/cadastroalunosobjetos/controllers/Controller_sala.php/updateSala"){
    $nome_sala = $_POST['nome_sala'];
    $serie = $_POST['serie'];
    $id_sala = $_POST['id_sala'];
    $sala->updateSala($id_sala,$nome_sala,$serie);
}

// buscar uma sala
if($url == "/cadastroalunosobjetos/controllers/Controller_sala.php/buscarSala"){
    $id_sala = $_POST['id_sala'];
    echo $sala->buscarSala($id_sala);
}