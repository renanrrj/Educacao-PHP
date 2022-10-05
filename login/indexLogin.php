<?php
    require_once "../mysql.php";

    $sqlAlunos = "SELECT idaluno,nmaluno FROM aluno";
    $sqlLogin = "SELECT l.*, a.nmaluno FROM login l INNER JOIN aluno a on a.idaluno = l.idaluno ORDER BY dslogin";

    $listaAlunos = selectRegistros($sqlAlunos);
    $listaLoginTable = selectRegistros($sqlLogin);
    $listaLogin = $listaLoginTable;

    array_unshift($listaLogin,["dslogin" => "","nmaluno" => "","dssenha" => ""]);
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
        <a class="menu_option" href="../alunoMatriculado/indexAMatriculado.php">Aluno matriculado</a>
        <a class="menu_option" href="../avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option" href="../avaliacaoaluno/indexAvaliacaoaluno.php">Avaliação do aluno</a>
        <a class="menu_option activated">Login</a>
    </div>

    <h2>Logins</h2>
    <form id="form" method="POST" action="insertLogin.php" onSubmit="return valida_dados(this)">
        <p>
            Selecionado:
            <select name="selLogin">
                <?php
                    foreach($listaLogin as $login){
                ?>
                    <option value="<?php echo $login['dslogin'] ?>"><?php echo ucfirst(strtolower($login['dslogin'])) ?></option>
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
            Login: <input type="text" name="login" size="20">
        </p>
        <p>
            Senha: <input type="password" name="senha" size="20">
        </p>
        <p>
            Confirme sua senha: <input type="password" name="confirmacao" size="20">
        </p>
    </form>

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = 'insertLogin.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = 'updateLogin.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = 'deleteLogin.php'; document.getElementById('form').submit()">

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Login</th>
            <th class="tableHeaderCell">Senha</th>
            <th class="tableHeaderCell">Aluno</th>
        </thead>
        <tbody>
            <?php
                foreach($listaLoginTable as $login){
            ?>
            <tr>
                <td class="tableCell"><?php echo $login['dslogin']?></td>
                <td class="tableCell"><?php echo $login['dssenha']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($login['nmaluno']))?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>

</html>