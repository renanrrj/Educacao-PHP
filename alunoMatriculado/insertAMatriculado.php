<?php
 require_once '../mysql.php';

$idAlunomatriculado = addslashes ($_POST['idAlunosmatric']);
$idAluno = addslashes($_POST['idAluno']);
$idMateria = addslashes ($_POST['idMateria']);

$sqlAlunomatriculado = "SELECT * FROM alunomatriculado where idaluno = $idAluno";  
    $listaidAluno = selectRegistros($sqlAlunomatriculado);

    $validado = true;

    if($listaidAluno != [] ){ ## ERRO
        $validado = false;
        echo 'Inserção nao permitida';
    }

    # ID

    $idAluno = 1;
$idLivre = false;
while($idLivre == false){
    $sqlIdAluno = "SELECT * FROM aluno WHERE `idaluno` = $idAluno";
    $resultadoIdAluno = selectRegistros($sqlIdAluno);

    if($resultadoIdAluno == []){
        $idLivre = true;
    }else{
        $idAluno++;
    }
}



     //* INSERINDO DADO
if($validado){
    $sqlInAluno = "INSERT INTO `alunomatriculado`(`idaluno`, `idmateria`, `idalunomatriculado`) VALUES($idAluno, '$idMateria', '$idAlunomatriculado')"; # ERRO
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;
}
?>