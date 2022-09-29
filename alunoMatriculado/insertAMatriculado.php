<?php
 require_once '../mysql.php';

$idAlunomatriculado = addslashes ($_POST['idAlunosmatric']);
$idAluno = addslashes($_POST['idAluno']);
$idMateria = addslashes ($_POST['idMateria']);

if(is_numeric($idAlunomatriculado))
{
    $sqlAlunoMatriculado = "SELECT * FROM alunomatriculado where idalunomatriculado = $idAlunomatriculado";  
    $listaAlunoMatriculado = selectRegistros($sqlAlunoMatriculado);

    if($listaAlunoMatriculado == []){
        $sqlinAmatriculado = "INSERT INTO `alunomatriculado` VALUES ('$idAlunomatriculado', '$idMateria', '$idAluno')";
        $resultado = insereRegistro($sqlinAmatriculado);
    
        echo $resultado;
    }else{
        echo "Este id já está sendo utilizado, tente outro!";
    }
}
?>