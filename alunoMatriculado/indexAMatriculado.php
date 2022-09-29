<?php
    require_once "../mysql.php";

    $sqlAlunoMatriculado = "SELECT am.idalunomatriculado, CONCAT(a.nmaluno,' / ', m.dsmateria) as conteudo FROM alunomatriculado am INNER JOIN aluno a on a.idaluno = am.idaluno INNER JOIN materia m on m.idmateria = am.idmateria";
    
    $sqlAlunos = "SELECT idaluno,nmaluno FROM aluno";
    $sqlMaterias = "SELECT idmateria,dsmateria FROM materia";

    $listaAlunosmatriculados = selectRegistros($sqlAlunoMatriculado);
    $listaAlunos = selectRegistros($sqlAlunos);
    $listaMaterias = selectRegistros($sqlMaterias);

    array_unshift($listaAlunosmatriculados,["idalunomatriculado" => "","conteudo" => ""]);
?> 

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- Login -</title>

    <link href="../style.css" rel="stylesheet"></link>

    <script language="javascript">
        function valida_dados(nomeform) {
            if (nomeform.login.value.length < 5 || nomeform.login.value.length > 15) {
                alert("O login deve conter entre 5 e 15 caracteres.");
                return false;
            }
            if (nomeform.login.value.indexOf(' ', 0) != -1) {
                alert("O login não pode conter espaços em branco.");
                return false;
            }
            if (nomeform.senha.value.length < 5 || nomeform.senha.value.length > 15) {
                alert("A senha deve conter entre 5 e 15 caracteres.");
                return false;
            }
            if (nomeform.senha.value.indexOf(' ', 0) != -1) {
                alert("A senha não pode conter espaços em branco.");
                return false;
            }
            if (nomeform.senha.value != nomeform.confirmacao.value) {
                alert("Senhas não conferem. Você digitou duas senhas diferentes.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="menu">
        <a class="menu_option" href="../index.php">Aluno</a>
        <a class="menu_option" href="../materia/indexMateria.php">Matéria</a>
        <a class="menu_option activated" href="">Aluno matriculado</a>
        <a class="menu_option" href="../avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option" href="">Avaliação do aluno</a>
        <a class="menu_option" href="../login/indexLogin.php">Login</a>
    </div>

    <h2>Crie seu login e senha</h2>
    <form id="form" method="POST" action="insertAvaliacao.php" onSubmit="return valida_dados(this)">
        <p>
            Id:
            <select name="idAluno">
                <?php
                    foreach($listaAlunosmatriculados as $alunoM){
                ?>
                    <option value="<?php echo $alunoM['idalunomatriculado'] ?>"><?php echo ucfirst(strtolower($alunoM['conteudo'])) ?></option>
                <?php
                    }
                ?>
            </select>
        </p>
        <p>
            Aluno:
            <select name="idAluno">
                <?php
                    foreach($listaAlunos as $aluno){
                ?>
                    <option value="<?php echo $aluno['idaluno'] ?>"><?php echo ucfirst(strtolower($aluno['nmaluno'])) ?></option>
                <?php
                    }
                ?>
            </select>
        </p>
        <p>
            Matéria:
            <select name="idMateria">
                <?php
                    foreach($listaMaterias as $materia){
                ?>
                    <option value="<?php echo $materia['idmateria'] ?>"><?php echo ucfirst(strtolower($materia['dsmateria'])) ?></option>
                <?php
                    }
                ?>
            </select>
        </p>
    </form>

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = 'insertAMatriculado.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = 'updateAMatriculado.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = 'deleteAMatriculado.php'; document.getElementById('form').submit()">
</body>

</html>