<?php
    require_once "../mysql.php";

    $sqlAvaliacaoAluno = "SELECT aa.idavaliacaoaluno, CONCAT(av.dsavaliacao,' / ',m.dsmateria,' / ',al.nmaluno) as conteudo FROM avaliacaoaluno aa 
    INNER JOIN avaliacao av ON av.idavaliacao = aa.idavaliacao 
    INNER JOIN materia m ON m.idmateria = av.idmateria 
    INNER JOIN aluno al ON al.idaluno = aa.idaluno 
    ORDER BY conteudo; ";

    $sqlAvalicaoAlunoTable = "SELECT aa.idavaliacaoaluno, CONCAT(av.dsavaliacao,' / ',m.dsmateria) as avaliacao, al.nmaluno, aa.nota FROM avaliacaoaluno aa 
    INNER JOIN avaliacao av ON av.idavaliacao = aa.idavaliacao 
    INNER JOIN materia m ON m.idmateria = av.idmateria
    INNER JOIN aluno al ON al.idaluno = aa.idaluno
    ORDER BY aa.idavaliacaoaluno";

    $sqlAvaliacao = "SELECT a.idavaliacao, CONCAT(a.dsavaliacao,' / ',m.dsmateria) as nmavaliacao FROM avaliacao a
    INNER JOIN materia m on a.idmateria = m.idmateria 
    ORDER BY nmavaliacao";

    $sqlAluno = "SELECT * FROM aluno";

    $listaAvaliacaoAluno = selectRegistros($sqlAvaliacaoAluno);
    $listaAvaliacaoAlunoTable = selectRegistros($sqlAvalicaoAlunoTable);
    $listaAvaliacao = selectRegistros($sqlAvaliacao);
    $listaAluno = selectRegistros($sqlAluno);

    array_unshift($listaAvaliacaoAluno,["idavaliacaoaluno" => "","conteudo" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- AVALIAÇÃO ALUNO -</title>

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
        <a class="menu_option" href="../alunoMatriculado/indexAMatriculado.php">Aluno matriculado</a>
        <a class="menu_option" href="../avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option activated" href="">Avaliação do aluno</a>
        <a class="menu_option" href="../login/indexLogin.php">Login</a>
    </div>

    <h2>Avaliações</h2>
    <form id="form" method="POST" action="insertAvaliacao.php" onSubmit="return valida_dados(this)">
        <p>
            Avaliação do Aluno:
            <select name="idAvaliacaoAluno">
                <?php
                    foreach($listaAvaliacaoAluno as $avaliacaoA){
                ?>
                    <option value="<?php echo $avaliacaoA['idavaliacaoaluno'] ?>"><?php echo ucfirst(strtolower($avaliacaoA['conteudo'])) ?></option>
                <?php
                    }
                ?>
            </select>

            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>
        </p>
        <p>
            Avaliação:
            <select name="idAvaliacao">
                <?php
                    foreach($listaAvaliacao as $avaliacao){
                ?>
                    <option value="<?php echo $avaliacao['idavaliacao'] ?>"><?php echo ucfirst(strtolower($avaliacao['nmavaliacao'])) ?></option>
                <?php
                    }
                ?>
            </select>
        </p>
        <p>
            Aluno:
            <select name="idAluno">
                <?php
                    foreach($listaAluno as $aluno){
                ?>
                    <option value="<?php echo $aluno['idaluno'] ?>"><?php echo ucfirst(strtolower($aluno['nmaluno'])) ?></option>
                <?php
                    }
                ?>
            </select>
        </p>
        <p>
            Notas: <input type="text" name="nota" size="20">
        </p>
    </form>

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = 'insertAvaliacao.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = 'updateAvaliacao.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = 'deleteAvaliacao.php'; document.getElementById('form').submit()">

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Id</th>
            <th class="tableHeaderCell">Avaliação</th>
            <th class="tableHeaderCell">Aluno</th>
            <th class="tableHeaderCell">Nota</th>
        </thead>
        <tbody>
            <?php
                foreach($listaAvaliacaoAlunoTable as $avaliacaoA){
            ?>
            <tr>
                <td class="tableCell"><?php echo $avaliacaoA['idavaliacaoaluno']?></td>
                <td class="tableCell"><?php echo $avaliacaoA['avaliacao']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($avaliacaoA['nmaluno']))?></td>
                <td class="tableCell"><?php echo $avaliacaoA['nota']?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>