<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- ALUNO -</title>

    <link href="./style.css" rel="stylesheet">
    </link>
</head>

<body>
    <div class="menu">
        <a class="menu_option activated" href="">Aluno</a>
        <a class="menu_option" href="./materia/indexMateria.php">Matéria</a>
        <a class="menu_option" href="./alunoMatriculado/indexAMatriculado.php">Aluno matriculado</a>
        <a class="menu_option" href="./avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option" href="">Avaliação do aluno</a>
        <a class="menu_option" href="./login/indexLogin.php">Login</a>
    </div>
    <h2>Preencha com o nome do aluno</h2>
    <form method="POST" action="./validaaluno.php" id="form">
        <p>
            Id do aluno: 
            <input type="text" class="input" name="idaluno"/>
            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>
        </p>
        <p>Nome do aluno: <input type="text" class="input" name="nmaluno"/></p>
    </form>

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = './aluno/insertAluno.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = './aluno/updateAluno.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = './aluno/deleteAluno.php'; document.getElementById('form').submit()">
</body>
</html>