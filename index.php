<?php
require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro alunos</title>
    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid;
            width: auto;
        }

        div {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Cadastro Alunos</h2>
    <form method="post" action=<?php echo htmlspecialchars('db.php'); ?>>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        Nome:
        <input type="text" name="nome" value="<?php echo $nome ?>" />
        Idade:
        <input type="number" name="idade" value="<?php echo $idade ?>" />
        CPF:
        <input type="number" name="cpf" value="<?php echo $cpf ?>" />
        <?php
        if ($update) {
            echo '<input type="submit" value="Atualizar" name="update">';
        } else {
            echo '<input type="submit" value="Adicionar" name="salvar">';
        }
        ?>
    </form>

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
                    <td><a href="db.php?delete=<?php echo $aluno['id'] ?>">Apagar</a></td>
                    <td><a href="index.php?edit=<?php echo $aluno['id'] ?>">Editar</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

</body>

</html>