<?php
/*
CREATE TABLE salas(
id INT AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(100),
serie VARCHAR(100)
);

ALTER TABLE alunos ADD id_sala INT NOT NULL;

*/
require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastar Salas</title>
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
    <form method="post" action=<?php echo htmlspecialchars('salas.php'); ?>>
        <input type="hidden" name="id_sala" value="<?php echo $id_sala ?>">
        Nome:
        <input type="text" name="nome_sala" value="<?php echo $nome_sala ?>" />
        Serie:
        <input type="text" name="serie_sala" value="<?php echo $serie_sala ?>" />
        <?php
        if ($update_sala) {
            echo '<button type="submit" name="update_sala">Atualizar</button>';
        } else {
            echo '<button type="submit" name="adicionar_sala">Adicionar</button>';
        }
        ?>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Serie</th>
                </tr>
            </thead>
            <?php
            foreach ($salas as $sala) :
            ?><tr>
                    <td><?php echo $sala['nome']; ?></td>
                    <td><?php echo $sala['serie']; ?></td>
                    <td><a href="salas.php?delete_sala=<?php echo $sala['id'] ?>">Apagar</a></td>
                    <td><a href="salas.php?edit_sala=<?php echo $sala['id'] ?>">Editar</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</body>

</html>