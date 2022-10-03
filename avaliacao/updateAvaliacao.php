<?php
require_once '../mysql.php';

$idAvaliacao = addslashes($_POST['IdAvaliacao']);
$Descricao = $_POST['DEScricao'];
$idMateria = $_POST['IdMateria'];   
$validado = true;

$listaAvaliacao = [];
if(!is_numeric($idAvaliacao)){
    $validado = false;
}else{
    $sqlidAvaliacao = "SELECT idavaliacao FROM avaliacao where idavaliacao = $idAvaliacao";  
    $listaAvaliacao = selectRegistros($sqlidAvaliacao);
}

//! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
if($listaAvaliacao == []){
    $validado = false;
    echo 'Edição não permitida';
}
if($validado){
    $sqlUpAvaliacao = "UPDATE `avaliacao` SET `idavaliacao` = '$idAvaliacao', `dsavaliacao` = '$Descricao', `idmateria` = '$idMateria' WHERE `idavaliacao` = '$idAvaliacao'";
    $resultado = updateRegistro($sqlUpAvaliacao);
    
    echo $resultado;    
}else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}
