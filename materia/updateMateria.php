<?php
require_once '../mysql.php';

$dsMateria = $_POST['dsmateria'];
$idMateria = $_POST['idmateria']; 

$validado = true;

$listaMateria = [];
if(!is_numeric($idMateria)){
    $validado= false;
}else{
    $sqlMateria = "SELECT dsmateria FROM materia where idmateria = $idMateria";
    $listaMateria = selectRegistros($sqlMateria);
}

//! VERIFICA SE EXISTE ALGUM ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
if($listaMateria == []){
    $validado = false;
    echo 'Edição não permitida - ';
}

if($validado){
    $sqlupMateria = "UPDATE `materia` SET `dsmateria` = '$dsMateria' WHERE `idmateria` = $idMateria";
    $resultado = updateRegistro($sqlupMateria);

    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`./indexMateria.php`)'>Voltar</button>";
?>