<?php
require_once '../mysql.php';

$idMateria = $_POST['idmateria'];
$validado = true;

$listaMateria = [];

//! VERIFICA SE O ID DA MATÉRIA É UM NÚMERO 
if(!is_numeric($idMateria)){
    $validado = false;
}
else{
    $sqlMateria = "SELECT * FROM materia where idmateria = $idMateria";
    $listaMateria = selectRegistros($sqlMateria);
}

//! VERIFICA SE EXISTE ALGUMA MATÉRIA COM ESSE ID, É NECESSÁRIO QUE EXISTA
if($listaMateria=[]){
    $validado=false;
    echo "Deleção nao permitida, registro não encontrado!";
}
if($validado){
    $sqldelMateria = "DELETE FROM `materia` WHERE `idmateria` = $idMateria";
    $resultado = deleteRegistro($sqldelMateria);

    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`./indexMateria.php`)'>Voltar</button>";
?>