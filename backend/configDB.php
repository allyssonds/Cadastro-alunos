<?php
// dados para a conexão
$severname = "localhost";
$username = "root";
$password = "";
$database = "mydb";

// cria conexão
$mysqli = new mysqli($severname, $username, $password, $database);

// Prepared Statements
$stmt = $mysqli->stmt_init();

// checa a conexão
if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco: " . $mysqli->connect_error);
}