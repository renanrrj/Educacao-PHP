<?php
    require_once "../mysql.php";

    $sqlAvaliacao = "SELECT a.idavaliacao, CONCAT(a.dsavaliacao,' / ',m.dsmateria) as nmavaliacao FROM avaliacao a
    INNER JOIN materia m on a.idmateria = m.idmateria 
    ORDER BY nmavaliacao";
    
    $sqlAvalicaoTable = "SELECT a.*, m.dsmateria FROM avaliacao a INNER JOIN materia m on a.idmateria = m.idmateria ORDER BY a.idavaliacao";
    $sqlMateria = "SELECT idmateria,dsmateria FROM materia";

    $listaAvaliacao = selectRegistros($sqlAvaliacao);
    $listaAvaliacaoTable = selectRegistros($sqlAvalicaoTable);
    $listaMaterias = selectRegistros($sqlMateria);

    array_unshift($listaAvaliacao,["idavaliacao" => "","nmavaliacao" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- AVALIAÇÃO -</title>

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
        <a class="menu_option activated" href="">Avaliação</a>
        <a class="menu_option" href="../avaliacaoaluno/indexAvaliacaoaluno.php">Avaliação do aluno</a>
        <a class="menu_option" href="../login/indexLogin.php">Login</a>
    </div>

    <h2>Avaliações</h2>
    <form id="form" method="POST" action="insertAvaliacao.php" onSubmit="return valida_dados(this)">
        <p>
            Avaliação:
            <select name="IdAvaliacao">
                <?php
                    foreach($listaAvaliacao as $avaliacao){
                ?>
                    <option value="<?php echo $avaliacao['idavaliacao'] ?>"><?php echo ucfirst(strtolower($avaliacao['nmavaliacao'])) ?></option>
                <?php
                    }
                ?>
            </select>
            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>

        </p>
        <p>
            Descrição: <input type="text" name="DEScricao" size="20">
        </p>
        <p>
            Matéria:
            <select name="IdMateria">
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

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = 'insertAvaliacao.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = 'updateAvaliacao.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = 'deleteAvaliacao.php'; document.getElementById('form').submit()">

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Id</th>
            <th class="tableHeaderCell">Nome</th>
            <th class="tableHeaderCell">Matéria</th>
        </thead>
        <tbody>
            <?php
                foreach($listaAvaliacaoTable as $avaliacao){
            ?>
            <tr>
                <td class="tableCell"><?php echo $avaliacao['idavaliacao']?></td>
                <td class="tableCell"><?php echo $avaliacao['dsavaliacao']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($avaliacao['dsmateria']))?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>