<?php
require_once '../mysql.php';

$dsMateria = $_POST['dsmateria'];
$idMateria = $_POST['idmateria']; 

$validado = true;

$listaMateria = [];
if(is_numeric($idMateria)){
    $validado= false;
}else
{
    $sqldsMateria = "SELECT dsmateria FROM materia where dsmateria = '$idMateria'";
    $listaMateria = selectRegistros($sqldsMateria);
}
    //! VERIFICA SE EXISTE ALGUM ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA

    if($listaMateria == []){
        $validado = false;
        echo 'Edição não permitida - ';
    }

    if($validado){
        $sqlupMateria = "UPDATE `materia` SET `dsmateria` = '$dsMateria' WHERE `idmateria` = '$idMateria'";
        $resultado = updateRegistro($sqlupMateria);
        echo "teste update";
        echo $resultado;
    }
else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}

# update `TABELA` set `NOME`= 'VARIÁVEL', `NOME`= 'VARIÁVEL' where `NOME`= 'VARIÁVEL';
?>  