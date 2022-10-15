<?php
require_once '../mysql.php';

$idAluno = $_POST['idAluno'];   
$validado = true;

$listaAlunos = [];
if(!is_numeric($idAluno)){
    $validado = false;
    echo 'Verifique o aluno escolhido e tente novamente!<br>';
}else{
    $sqlAluno = "SELECT idaluno FROM aluno where idaluno = $idAluno";  
    $listaAlunos = selectRegistros($sqlAluno);
}

//! VERIFICA SE EXISTE ALGUM ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
if($listaAlunos == []){
    $validado = false;
    echo 'Deleção não permitida, registro não encontrado!';
}
if($validado){
    $sqlDelAluno = "DELETE FROM `aluno` WHERE `idaluno` = $idAluno";
    $resultado = deleteRegistro($sqlDelAluno);
    
    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`../index.php`)'>Voltar</button>";
?>