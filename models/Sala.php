<?php

require_once('Database.php');

class Sala extends Database
{

    function salvarSala($nome_sala, $serie)
    {
        $this->stmt->prepare('INSERT INTO salas(nome_sala,serie) values(?,?)');
        $this->stmt->bind_param('ss', $nome_sala, $serie);
        $this->stmt->execute();
    }

    function buscarSala($id)
    {
        $this->stmt->prepare('SELECT * FROM salas WHERE id_sala=?');
        $this->stmt->bind_param('i', $id);
        $this->stmt->execute();
        $result = $this->stmt->get_result();
        $returnVar = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $returnVar[] = $row;
        };
        return json_encode($returnVar);
    }

    function updateSala($id_sala, $nome_sala, $serie)
    {
        $this->stmt->prepare("UPDATE salas SET nome_sala=?, serie=? WHERE id_sala=?");
        $this->stmt->bind_param('ssi', $nome_sala, $serie, $id_sala);
        $this->stmt->execute();
    }

    function apagarSala($id)
    {
        $this->stmt->prepare('DELETE FROM salas WHERE id_sala=?');
        $this->stmt->bind_param('i', $id);
        $this->stmt->execute();
    }

    function buscarSalas()
    {
        $result = $this->mysqli->query("SELECT * FROM salas", MYSQLI_USE_RESULT);
        $returnVar = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $returnVar[] = $row;
        }
        return $returnVar;
    }
}

$sala = new Sala();