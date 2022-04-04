<?php

require_once "Database.php";

class Aluno extends Database
{
    
    function salvarAluno($nome, $idade, $cpf, $id_sala)
    {
        $this->stmt->prepare("INSERT INTO alunos(nome,idade,cpf,id_sala) values(?,?,?,?)");
        $this->stmt->bind_param("siii", $nome, $idade, $cpf, $id_sala);
        $this->stmt->execute();
    }
    
    function buscarAluno($id)
    {
        $this->stmt->prepare("SELECT * FROM alunos WHERE id=?");
        $this->stmt->bind_param('i', $id);
        $this->stmt->execute();
        $result = $this->stmt->get_result();
        $returnVar = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $returnVar[] = $row;
        };
        return json_encode($returnVar);
    }
    
    function updateAluno($id, $nome, $idade, $cpf, $id_sala)
    {
        $this->stmt->prepare('UPDATE alunos SET nome=?, idade=?, cpf=?, id_sala=? WHERE id=?');
        $this->stmt->bind_param('siiii', $nome, $idade, $cpf, $id_sala, $id);
        $this->stmt->execute();
    }
    
    function apagarAluno($id)
    {
        $this->stmt->prepare('DELETE FROM alunos WHERE id=?');
        $this->stmt->bind_param('i', $id);
        $this->stmt->execute();
    }

    function buscarAlunos()
    {
        $result = $this->mysqli->query("SELECT * FROM `alunos` INNER JOIN salas on alunos.id_sala = salas.id_sala ", MYSQLI_USE_RESULT);
        $returnVar = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $returnVar[] = $row;
        }
        return $returnVar;
    }
}

$aluno = new Aluno();