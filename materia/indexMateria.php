<?php
    require_once "../mysql.php";

    $sqlMateriasLista = "SELECT * FROM materia ORDER BY dsmateria";
    $sqlMateriasTable = "SELECT * FROM materia ORDER BY idmateria";

    $listaMaterias = selectRegistros($sqlMateriasLista);
    $listaMateriasTable = selectRegistros($sqlMateriasTable);
    array_unshift($listaMaterias,["idmateria" => "","dsmateria" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- MATÉRIA -</title>

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
        <a class="menu_option activated" href="">Matéria</a>
        <a class="menu_option" href="../alunoMatriculado/indexAMatriculado.php">Aluno matriculado</a>
        <a class="menu_option" href="../avaliacao/indexAvaliacao.php">Avaliação</a>
        <a class="menu_option" href="../avaliacaoaluno/indexAvaliacaoaluno.php">Avaliação do aluno</a>
        <a class="menu_option" href="../login/indexLogin.php">Login</a>
    </div>

    <h2>Matérias</h2>
    <form id="form" method="POST" action="insertMateria.php" onSubmit="return valida_dados(this)">
        <p>
            Matéria:
            <select name="idmateria"> 
                <?php
                    foreach($listaMaterias as $materia){
                ?>
                    <option value="<?php echo $materia['idmateria'] ?>"><?php echo ucfirst(strtolower($materia['dsmateria'])) ?></option>
                <?php
                    }
                ?>
            </select>
            <b>Necessário preencher apenas para atualizar ou deletar, é ignorado ao inserir</b>
        </p>
        <p>
            Nome: <input type="text" name="dsmateria" size="20"> 
        </p>
    </form>

    <input type="button" value="Enviar" onclick="document.getElementById('form').action = 'insertMateria.php'; document.getElementById('form').submit()">
    <input type="button" value="Atualizar" onclick="document.getElementById('form').action = 'updateMateria.php'; document.getElementById('form').submit()">
    <input type="button" value="Deletar" onclick="document.getElementById('form').action = 'deleteMateria.php'; document.getElementById('form').submit()">

    <table class="table">
        <thead>
            <th class="tableHeaderCell">Id</th>
            <th class="tableHeaderCell">Nome</th>
        </thead>
        <tbody>
            <?php
                foreach($listaMateriasTable as $materia){
            ?>
            <tr>
                <td class="tableCell"><?php echo $materia['idmateria']?></td>
                <td class="tableCell"><?php echo ucfirst(strtolower($materia['dsmateria']))?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>

</html>

