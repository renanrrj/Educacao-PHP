<?php
    require_once "../mysql.php";

    $sqlAlunos = "SELECT idaluno,nmaluno FROM aluno";

    $listaAlunos = selectRegistros($sqlAlunos);
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
        <a class="menu_option" href="../">Avaliação do aluno</a>
        <a class="menu_option activated">Login</a>
    </div>

    <h2>Crie seu login e senha</h2>
    <form id="form" method="POST" action="insertLogin.php" onSubmit="return valida_dados(this)">
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
</body>

</html>