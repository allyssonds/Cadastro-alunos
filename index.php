<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro alunos</title>
    <?php
    require_once("db.php");
    ?>
    <style>
        table,tr,td,th
        {
            border: 1px solid;
            width: auto;
        }
        div{margin-top: 20px;}
    </style>
</head>

<body>
    <h2>Cadastro Alunos</h2>
    <form method="post" action=<?php echo htmlspecialchars('db.php'); ?>>
        Nome:
        <input type="text" name="nome" />
        Idade:
        <input type="number" name="idade" />
        CPF:
        <input type="number" name="cpf" />
        <input type="submit" value="Adicionar" name="adicionar">
    </form>
    <?php
    $conn = new mysqli($severname, $username, $password, $database) or die(mysqli_error($conn));
    $result = $conn->query("SELECT * FROM alunos");
    ?>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Idade</th>
                    <th>CPF</rh>
                </tr>
            </thead>
            <?php while ($aluno = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $aluno['nome']; ?></td>
                    <td><?php echo $aluno['idade']; ?></td>
                    <td><?php echo $aluno['cpf']; ?></td>
                    <td><a href="db.php?id=<?php echo $aluno['id'] ?>">Apagar</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>


</body>

</html>