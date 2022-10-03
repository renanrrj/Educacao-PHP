<?php
    require_once "../mysql.php";

    $sqlAlunoMatriculado = "SELECT am.idalunomatriculado, CONCAT(a.nmaluno,' / ', m.dsmateria) as conteudo FROM alunomatriculado am INNER JOIN aluno a on a.idaluno = am.idaluno INNER JOIN materia m on m.idmateria = am.idmateria ORDER BY conteudo";
    $sqlAlunoMatriculadoTable = "SELECT am.idalunomatriculado, a.nmaluno, m.dsmateria FROM alunomatriculado am INNER JOIN aluno a on a.idaluno = am.idaluno INNER JOIN materia m on m.idmateria = am.idmateria ORDER BY am.idalunomatriculado";

    $sqlAlunos = "SELECT idaluno,nmaluno FROM aluno ORDER BY nmaluno";
    $sqlMaterias = "SELECT idmateria,dsmateria FROM materia ORDER BY dsmateria";

    $listaAlunosMatriculados = selectRegistros($sqlAlunoMatriculado);
    $listaAlunosMatriculadosTable = selectRegistros($sqlAlunoMatriculadoTable);
    $listaAlunos = selectRegistros($sqlAlunos);
    $listaMaterias = selectRegistros($sqlMaterias);

    array_unshift($listaAlunosMatriculados,["idalunomatriculado" => "","conteudo" => ""]);
?> 

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- ALUNO MATRICULADO -</title>

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

    <h2>Alunos matriculados</h2>
    <form id="form" method="POST" action="insertAvaliacao.php" onSubmit="return valida_dados(this)">
        <p>
            Aluno matriculado:
            <select name="idAlunosmatric">
                <?php
                    foreach($listaAlunosMatriculados as $alunoM){
                ?>
                    <option value="<?php echo $alunoM['idalunomatriculado'] ?>"><?php echo ucfirst(strtolower($alunoM['conteudo'])) ?></option>
                <?php
                    }
                ?>
            </select>
            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>
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

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Id</th>
            <th class="tableHeaderCell">Aluno</th>
            <th class="tableHeaderCell">Matéria</th>
        </thead>
        <tbody>
            <?php
                foreach($listaAlunosMatriculadosTable as $alunoM){
            ?>
            <tr>
                <td class="tableCell"><?php echo $alunoM['idalunomatriculado']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($alunoM['nmaluno']))?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($alunoM['dsmateria']))?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>

</html>