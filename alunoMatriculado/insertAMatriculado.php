<?php
 require_once '../mysql.php';

$idAlunomatriculado = addslashes ($_POST['idAlunosmatric']);
$idAluno = addslashes($_POST['idAluno']);
$idMateria = addslashes ($_POST['idMateria']);

$sqlAlunomatriculado = "SELECT * FROM alunomatriculado where idaluno = $idAluno";  
    $listaidAluno = selectRegistros($sqlAlunomatriculado);

    $validado = true;

    if($listanmAluno != [] ){
        $validado = false;
        echo 'Inserção nao permitida';
    }

    # ID

     //* INSERINDO DADO
if($validado){
    $sqlInAluno = "INSERT INTO `alunomatriculado`(`idaluno`, `nmaluno`) VALUES($idAluno, '$nmAluno')";
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;
}


# -------------------------------------------------------------------------------------

// if(is_numeric($idAlunomatriculado))
// {
//     $sqlAlunoMatriculado = "SELECT * FROM alunomatriculado where idalunomatriculado = $idAlunomatriculado";  
//     $listaAlunoMatriculado = selectRegistros($sqlAlunoMatriculado);

//     if($listaAlunoMatriculado == []){
//         $sqlinAmatriculado = "INSERT INTO `alunomatriculado` VALUES ('$idAlunomatriculado', '$idMateria', '$idAluno')";
//         $resultado = insereRegistro($sqlinAmatriculado);
    
//         echo $resultado;
//     }else{
//         echo "Este id já está sendo utilizado, tente outro!";
//     }
// }

?>