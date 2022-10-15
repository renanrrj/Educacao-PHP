<?php
require_once '../mysql.php';

$idAvaliacaoAluno = $_POST['idAvaliacaoAluno'];   
$validado = true;

$listaAvaliacaoAluno = [];

//! VERIFICA SE O ID DA AVALIAÇÃO DE ALUNO É UM NÚMERO 
if(!is_numeric($idAvaliacaoAluno)){
    $validado = false;
    echo 'Verifique a avaliação de aluno escolhida e tente novamente!<br>';
}else{
    $sqlAvaliacaoAluno = "SELECT * FROM avaliacaoaluno where idavaliacaoaluno = $idAvaliacaoAluno";  
    $listaAvaliacaoAluno = selectRegistros($sqlAvaliacaoAluno);
}

//! VERIFICA SE EXISTE ALGUMA AVALIAÇÃO DE ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
if($listaAvaliacaoAluno == []){
    $validado = false;
    echo 'Deleção não permitida, registro não encontrado!';
}
if($validado){
    $sqlDelAvaliacaoAluno = "DELETE FROM `avaliacaoaluno` WHERE `idavaliacaoaluno` = $idAvaliacaoAluno";
    $resultado = deleteRegistro($sqlDelAvaliacaoAluno);
    
    echo $resultado;    
}

echo "<br><br><button onclick='document.location.replace(`./indexAvaliacaoAluno.php`)'>Voltar</button>";
?>