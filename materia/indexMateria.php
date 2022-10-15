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

    <script>function updateButtons(select){
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
            <select name="idmateria" onchange="updateButtons(this)"> 
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
            Nome: <input type="text" name="dsmateria" size="20" required> 
        </p>
    </form>
    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertMateria.php'; document.getElementById('form').submit()">
    <input id="btnAtualizar" type="button" value="Atualizar" onclick="document.getElementById('form').action = './updateMateria.php'; document.getElementById('form').submit()" disabled>
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteMateria.php'; document.getElementById('form').submit()" disabled>
   

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

