<?php # COMPLETO
require_once '../mysql.php';

$idAluno = $_POST['idAluno'];   
$nmAluno = addslashes($_POST['nmaluno']);

$validado = true;

$listaAlunos = [];
if(!is_numeric($idAluno)){
    $validado = false;
}else{
    $sqlAluno = "SELECT idaluno FROM aluno where idaluno = $idAluno";  
    $listaAlunos = selectRegistros($sqlAluno);
}

//! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
if($listaAlunos == []){
    $validado = false;
    echo 'Edição não permitida';
}
if($validado){
    $sqlUpAluno = "UPDATE `aluno` SET `nmaluno` = '$nmAluno' WHERE `idaluno` = '$idAluno'";
    $resultado = updateRegistro($sqlUpAluno);
    
    echo $resultado;    
}else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}
