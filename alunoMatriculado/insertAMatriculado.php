<?php
 require_once '../mysql.php';

$idAluno = $_POST['idAluno'];
$idMateria = $_POST['idMateria'];

$validado = true;
$listaAluno = [];
$listaMateria = [];

//^ VERIFICANDO SE OS ids SÃO NÚMEROS ANTES DE FAZER O SELECT
if(is_numeric($idAluno) && is_numeric($idMateria)){
    $sqlAluno = "SELECT * FROM aluno where idaluno = $idAluno";  
    $listaAluno = selectRegistros($sqlAluno);

    $sqlMateria = "SELECT * FROM materia where idmateria = $idMateria";  
    $listaMateria = selectRegistros($sqlMateria);
}else{
    $validado = false;
    echo 'Verifique o aluno e a matéria escolhidos e tente novamente!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO O ALUNO ESCOLHIDO
if($listaAluno == []){
    $validado = false;
    echo 'Inserção não permitida, o aluno escolhido não foi encontrado!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO A MATÉRIA ESCOLHIDA
if($listaMateria == []){
    $validado = false;
    echo 'Inserção não permitida, a matéria escolhida não foi encontrada!<br>';
}

//* CRIANDO ID
$idAlunoM = 1;
$idLivre = false;
while($idLivre == false){
    $sqlIdAlunoM = "SELECT * FROM alunomatriculado WHERE `idalunomatriculado` = $idAlunoM";
    $resultadoIdAlunoM = selectRegistros($sqlIdAlunoM);

    if($resultadoIdAlunoM == []){
        $idLivre = true;
    }else{
        $idAluno++;
    }
}

//* INSERINDO DADO
if($validado){
    $sqlInAluno = "INSERT INTO `alunomatriculado`(`idaluno`, `idmateria`, `idalunomatriculado`) VALUES($idAluno, $idMateria, $idAlunoM)";
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`./indexAMatriculado.php`)'>Voltar</button>";
?>