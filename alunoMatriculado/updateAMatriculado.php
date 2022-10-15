<?php
require_once '../mysql.php';

$idAmatriculado = $_POST['idAlunosmatric'];
$idAluno = $_POST['idAluno'];
$idMateria = $_POST['idMateria'];   
$validado = true;

$listaAlunomatric = [];
$listaAluno = [];
$listaMateria = [];

//^ VERIFICANDO SE OS ids SÃO NÚMEROS ANTES DE FAZER O SELECT
if(!is_numeric($idAmatriculado) || !is_numeric($idAluno) || !is_numeric($idMateria)){
    $validado = false;
    echo 'Verifique o aluno matriculado, alunos e materia escolhidos e tente novamente!<br>';
}else{
    $sqlAlunomatric = "SELECT idalunomatriculado FROM alunomatriculado where idAlunomatriculado = $idAmatriculado";  
    $listaAlunomatric = selectRegistros($sqlidAlunomatric);

    $sqlAluno = "SELECT * FROM aluno where idaluno = $idAluno";  
    $listaAluno = selectRegistros($sqlAluno);

    $sqlMateria = "SELECT * FROM materia where idmateria = $idMateria";  
    $listaMateria = selectRegistros($sqlMateria);
}

//^ VERIFICANDO SE FOI ENCONTRADO O ALUNO-MATRICULADO ESCOLHIDO
if($listaAlunomatric == []){
    $validado = false;
    echo 'Alteração não permitida, o aluno matriculado escolhido não foi encontrado!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO O ALUNO ESCOLHIDO
if($listaAluno == []){
    $validado = false;
    echo 'Alteração não permitida, o aluno escolhido não foi encontrado!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO A MATÉRIA ESCOLHIDA
if($listaMateria == []){
    $validado = false;
    echo 'Alteração não permitida, a materia escolhida não foi encontrada!<br>';
}

if($validado){
    $sqlUpAlunomatric = "UPDATE `alunomatriculado` SET `idaluno` = $idAluno, `idmateria` = $idMateria WHERE `idalunomatriculado` = $idAmatriculado";
    $resultado = updateRegistro($sqlUpAlunomatric);
    
    echo $resultado;    
}

echo "<br><br><button onclick='document.location.replace(`./indexAMatriculado.php`)'>Voltar</button>";
?>