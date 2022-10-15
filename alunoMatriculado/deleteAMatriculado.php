<?php
require_once '../mysql.php';

$idAmatriculado = $_POST['idAlunosmatric'];
$validado = true;

$listaAvaliacao = [];

//! VERIFICA SE O ID Do ALUNO MATRICULADO É UM NÚMERO 
if(!is_numeric($idAmatriculado)){
    $validado = false;
    echo 'Verifique o aluno matriculado, alunos e materia escolhidos e tente novamente!<br>';
}else{
    $sqlidAmatriculado = "SELECT idalunomatriculado FROM alunomatriculado where idAlunomatriculado = $idAmatriculado"; 
    $listaidAmatriculado = selectRegistros($sqlidAmatriculado);
}

if($listaAvaliacao=[]){
    $validado=false;
    echo 'Deleção não permitida, registro não encontrado!';
}
if($validado){
    $sqldelAmatriculado = "DELETE FROM `alunomatriculado` WHERE `idalunomatriculado` = $idAmatriculado";
    $resultado = deleteRegistro($sqldelAmatriculado);

    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`./indexAMatriculado.php`)'>Voltar</button>";
?>