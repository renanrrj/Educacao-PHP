<?php
require_once '../mysql.php';

$idAmatriculado = addslashes($_POST['idAlunosmatric']);
$idAluno = $_POST['idAluno'];
$idMateria = $_POST['idMateria'];   

$validado = true;
$listaAlunomatric = [];
if(!is_numeric($idAmatriculado)){
    $validado = false;
}else{
    $sqlidAlunomatric = "SELECT idalunomatriculado FROM alunomatriculado where idAlunomatriculado = $idAmatriculado";  
    $listaAlunomatric = selectRegistros($sqlidAlunomatric);
}

//! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
if($listaAlunomatric == []){
    $validado = false;
    echo 'Edição não permitida';
}
if($validado){
    $sqlUpAlunomatric = "UPDATE `alunomatriculado` SET `idalunomatriculado` = '$idAmatriculado', `idaluno` = '$idAluno', `idmateria` = '$idMateria' WHERE `idalunomatriculado` = '$idAmatriculado'";
    $resultado = updateRegistro($sqlUpAlunomatric);
    
    echo $resultado;    
}else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}
