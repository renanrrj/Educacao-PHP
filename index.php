<?php
    require_once "./mysql.php";

    $sqlAlunos = "SELECT * FROM aluno ORDER BY nmaluno";
    $sqlAlunosTable = "SELECT * FROM aluno ORDER BY idaluno";

    $listaAlunos = selectRegistros($sqlAlunos);
    $listaAlunosTable = selectRegistros(($sqlAlunosTable));

    array_unshift($listaAlunos,["idaluno" => "","nmaluno" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- ALUNO -</title>

    <link href="./style.css" rel="stylesheet">
    </link>

    <script>
        function updateButtons(select){
            const btnEnviar = document.getElementById('btnEnviar')
            const btnAtualizar = document.getElementById('btnAtualizar')
            const btnDeletar = document.getElementById('btnDeletar')

            if(select.value == ""){
                btnEnviar.disabled = false
                btnAtualizar.disabled = true
                btnDeletar.disabled = true
            }else{
                btnEnviar.disabled = true
                btnAtualizar.disabled = false
                btnDeletar.disabled = false
            }
        }
    </script>
</head>

<body>
    <div class="menu">
        <a class="menu_option activated" href="">Aluno</a>
        <a class="menu_option" href="./materia/indexMateria.php">Matéria</a>
        <a class="menu_option" href="./alunoMatriculado/indexAMatriculado.php">Aluno matriculado</a>
        <a class="menu_option" href="./avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option" href="./avaliacaoaluno/indexAvaliacaoaluno.php">Avaliação do aluno</a>
        <a class="menu_option" href="./login/indexLogin.php">Login</a>
    </div>
    <h2>Alunos</h2>
    <form method="POST" action="./validaaluno.php" id="form">
        <p>
            Aluno: 
            <select name="idAluno" onchange="updateButtons(this)">
                <?php
                    foreach($listaAlunos as $aluno){
                ?>
                    <option value="<?php echo $aluno['idaluno'] ?>"><?php echo ucfirst(strtolower($aluno['nmaluno'])) ?></option>
                <?php
                    }
                ?>
            </select>
            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>
        </p>
        <p>Nome do aluno: <input type="text" class="input" name="nmaluno" required/></p>
    </form>

    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './aluno/insertAluno.php'; document.getElementById('form').submit()">
    <input id="btnAtualizar" type="button" value="Atualizar" onclick="document.getElementById('form').action = './aluno/updateAluno.php'; document.getElementById('form').submit()" disabled>
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './aluno/deleteAluno.php'; document.getElementById('form').submit()" disabled>

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Id</th>
            <th class="tableHeaderCell">Nome</th>
        </thead>
        <tbody>
            <?php
                foreach($listaAlunosTable as $aluno){
            ?>
            <tr>
                <td class="tableCell"><?php echo $aluno['idaluno']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($aluno['nmaluno']))?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>