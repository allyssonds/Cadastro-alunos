<?php
/* sql usado para criar o banco de dados:

    CREATE DATABASE mydb;

    CREATE TABLE alunos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    idade INT,
    cpf INT
    )

*/

// dados para a conexão
$severname = "localhost";
$username = "root";
$password = "";
$database = "mydb";

// cria conexão
$conn = new mysqli($severname, $username, $password, $database);

// checa a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco: " . $conn->connect_error);
}

// recebe os dados e salva na tabela do banco
if (isset($_POST["adicionar"])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $cpf = $_POST["cpf"];
    $conn->query("INSERT INTO alunos(nome,idade,cpf) values('$nome','$idade','$cpf')");

    header("location: index.php");
}

// recebe o id do aluno e apaga o registro do banco
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("DELETE FROM alunos WHERE id=$id");

    header("location: index.php");
}

// encerra conexão com o banco de dados
$conn->close();