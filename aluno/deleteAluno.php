<?php # COMPLETO
require_once '../mysql.php';

$idAluno = $_POST['idAluno'];   
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
    echo 'Deleção não permitida';
}else{
    $sqlDelAluno = "DELETE FROM `aluno` WHERE `idaluno` = $idAluno";
    $resultado = deleteRegistro($sqlDelAluno);
    
    echo $resultado;
}