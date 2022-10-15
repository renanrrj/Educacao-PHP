<?php
require_once '../mysql.php';

$idMateria = $_POST['IdMateria'];
$idAvaliacao = $_POST['IdAvaliacao'];
$descricao = addslashes ($_POST['DEScricao']);
$validado = true;

$listaAvaliacao = [];

//! VERIFICA SE O ID DA AVALIAÇÃO É UM NÚMERO 
if(!is_numeric($idAvaliacao)){
    $validado = false;
}
else{
    $sqlAvaliacao = "SELECT * FROM avaliacao where idavaliacao = $idAvaliacao";
    $listaAvaliacao = selectRegistros($sqlAvaliacao);
}

//! VERIFICA SE EXISTE ALGUMA AVALIAÇÃO DE ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
if($listaAvaliacao=[]){
    $validado=false;
    echo "Deleção não permitida, registro não encontrado!";
}

if($validado){
    $sqldelAvaliacao = "DELETE FROM `avaliacao` WHERE `idavaliacao` = $idAvaliacao";
    $resultado = deleteRegistro($sqldelAvaliacao);

    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`./indexAvaliacao.php`)'>Voltar</button>";
?>