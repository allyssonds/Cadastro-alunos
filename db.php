<?php
/* sql usado para criar o banco de dados:
    CREATE DATABASE mydb;
    
    CREATE TABLE alunos(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        idade INT,
        cpf INT
    );

    CREATE TABLE salas(
        id_sala INT AUTO_INCREMENT PRIMARY KEY,
        nome_sala VARCHAR(100),
        serie VARCHAR(100)
    );

    ALTER TABLE alunos ADD id_sala INT NOT NULL;

    ALTER TABLE `alunos` ADD FOREIGN KEY (`id_sala`) REFERENCES `salas`(`id_sala`) ON DELETE RESTRICT ON UPDATE CASCADE;

*/

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

// recebe os dados e salva na tabela do banco
if (isset($_POST["salvar"])) {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $cpf = $_POST["cpf"];
    $id_sala = $_POST['id_sala'];

    // prepara a query sql
    $stmt->prepare("INSERT INTO alunos(nome,idade,cpf,id_sala) values(?,?,?,?)");

    $stmt->bind_param("siii", $nome, $idade, $cpf, $id_sala);

    $stmt->execute();
}

// recebe o id do aluno e apaga o registro do banco
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $stmt->prepare("DELETE FROM alunos WHERE id=?");

    $stmt->bind_param("i", $id);

    $stmt->execute();
}

$id = "";
$nome = "";
$idade = "";
$cpf = "";
$update = false;



// Editar registro
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $stmt->prepare("SELECT * FROM alunos WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    if ($stmt) {
        $stmt->bind_result($id, $nome, $idade, $cpf, $id_sala);
        $stmt->fetch();
        $stmt->close();
        $update = true;
    }
}

// atualiza registro
if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $cpf = $_POST["cpf"];
    $id_sala = $_POST["id_sala"];

    $stmt->prepare("UPDATE alunos SET nome=?, idade=?, cpf=?, id_sala=? WHERE id=?");
    $stmt->bind_param('siiii', $nome, $idade, $cpf, $id_sala ,$id);
    $stmt->execute();

    $id = $nome = $idade = $cpf = "";
    $update = false;
}

///////////////////////////////////////////////////

// adicionar sala

// adicionar sala no banco
if (isset($_POST["adicionar_sala"])) {
    $nome_sala = $_POST["nome_sala"];
    $serie_sala = $_POST["serie_sala"];

    // prepara a query sql
    $stmt->prepare("INSERT INTO salas(nome_sala,serie) values(?,?)");

    $stmt->bind_param("ss", $nome_sala, $serie_sala);

    $stmt->execute();
}

// delete sala
if (isset($_GET["delete_sala"])) {
    $id_sala = $_GET["delete_sala"];

    $stmt->prepare("DELETE FROM salas WHERE id_sala=?");
    $stmt->bind_param('i', $id_sala);
    $stmt->execute();
}

$id_sala = "";
$nome_sala = "";
$serie_sala = "";
$update_sala = false;

// update sala
if (isset($_GET["edit_sala"])) {
    $id_sala = $_GET["edit_sala"];
    $stmt->prepare("SELECT * FROM salas WHERE id_sala=?");
    $stmt->bind_param('i', $id_sala);
    $stmt->execute();
    if ($stmt) {
        $stmt->bind_result($id_sala, $nome_sala, $serie_sala);
        $stmt->fetch();
        $stmt->close();
        $update_sala = true;
    }
}

if (isset($_POST["update_sala"])) {
    $id_sala = $_POST["id_sala"];
    $nome_sala = $_POST["nome_sala"];
    $serie_sala = $_POST["serie_sala"];

    $stmt->prepare("UPDATE salas SET nome_sala=?, serie=? WHERE id_sala=?");
    $stmt->bind_param("ssi", $nome_sala, $serie_sala, $id_sala);
    $stmt->execute();

    $id_sala = $nome_sala = $serie_sala = "";
    $update_sala = false;
}

// busca lista de alunos
$result = $mysqli->query("SELECT * FROM `alunos` INNER JOIN salas on alunos.id_sala = salas.id_sala ",MYSQLI_USE_RESULT);
$alunos = array();
while($aluno = $result->fetch_assoc()){
    array_push($alunos,$aluno);
}

// busca lista de salas
$result = $mysqli->query("SELECT * FROM salas",MYSQLI_USE_RESULT);
$salas = array();
while($sala = $result->fetch_assoc()){
    array_push($salas,$sala);
}

// encerra conexão com o banco de dados
$mysqli->close();