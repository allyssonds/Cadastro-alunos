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

$id = "";
$nome = "";
$idade = "";
$cpf = "";
$update = false;


// dados para a conexão
$severname = "localhost";
$username = "root";
$password = "";
$database = "mydb";

// cria conexão
$mysqli = new mysqli($severname, $username, $password, $database);

// busca todos os registros
$result = $mysqli->query("SELECT * FROM alunos");

// Prepared Statements
$stmt = $mysqli->stmt_init();


// checa a conexão
if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco: " . $mysqli->connect_error);
}

// recebe os dados e salva na tabela do banco
if (isset($_POST["salvar"])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $cpf = $_POST["cpf"];

    // prepara a query sql
    $stmt->prepare("INSERT INTO alunos(nome,idade,cpf) values(?,?,?)");

    $stmt->bind_param("sii", $nome, $idade, $cpf);

    $stmt->execute();

    header("location: index.php");
}

// recebe o id do aluno e apaga o registro do banco
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt->prepare("DELETE FROM alunos WHERE id=?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    header("location: index.php");
}

// Editar registro
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $stmt->prepare("SELECT * FROM alunos WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt) {
        $stmt->bind_result($id, $nome, $idade, $cpf);
        $stmt->fetch();
        $update = true;
    }
}

// atualiza registro
if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $cpf = $_POST["cpf"];

    $stmt->prepare("UPDATE alunos SET nome=?, idade=?, cpf=? WHERE id=?");
    $stmt->bind_param('siii', $nome, $idade, $cpf, $id);
    $stmt->execute();

    header("location: index.php");
}


// encerra conexão com o banco de dados
$mysqli->close();