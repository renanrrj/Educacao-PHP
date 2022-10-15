<?php
require_once '../mysql.php';

$idAvaliacaoAluno = $_POST['idAvaliacaoAluno'];
$idAluno = $_POST['idAluno'];
$idAvaliacao = $_POST['idAvaliacao'];
$nota = $_POST['nota'];

$validado = true;
$listaAluno = [];
$listaAvaliacao = [];
$listaAvaliacaoAluno = [];

//^ VERIFICANDO SE OS ids SÃO NÚMEROS ANTES DE FAZER O SELECT
if(is_numeric($idAluno) && is_numeric($idAvaliacao) && is_numeric($idAvaliacaoAluno)){
    $sqlAluno = "SELECT * FROM aluno where idaluno = $idAluno";
    $listaAluno = selectRegistros($sqlAluno);

    $sqlAvaliacao = "SELECT * FROM avaliacao where idavaliacao = $idAvaliacao";
    $listaAvaliacao = selectRegistros($sqlAvaliacao);

    $sqlAvaliacaoAluno = "SELECT * FROM avaliacaoaluno where idavaliacaoaluno = $idAvaliacaoAluno";
    $listaAvaliacaoAluno = selectRegistros($sqlAvaliacao);
}else{
    $validado = false;
    echo 'Verifique o aluno e a avaliação escolhidos e tente novamente!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO O ALUNO ESCOLHIDO
if($listaAluno == []){
    $validado = false;
    echo 'Alteração não permitida, o aluno escolhido não foi encontrado!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO A AVALIAÇÃO ESCOLHIDA
if($listaAvaliacao == []){
    $validado = false;
    echo 'Alteração não permitida, a avaliação escolhida não foi encontrada!<br>';
}

//^ VERIFICANDO SE FOI ENCONTRADO O AVALIACAO-ALUNO ESCOLHIDO
if($listaAvaliacaoAluno == []){
    $validado = false;
    echo 'Alteração não permitida, a avaliação de aluno escolhida não foi encontrada!<br>';
}

//^ VERIFICANDO SE A NOTA DIGITADA É UM NÚMERO E SE ESTÁ ENTRE 0 E 10
if(is_numeric($nota) == false || $nota > 10 || $nota < 0){
    $validado = false;
    echo 'Alteração nao permitida, nota inválida';
}

if($validado){
    $sqlUpAvaliacaoAluno = "UPDATE `avaliacaoaluno` SET `idavaliacao` = $idAvaliacao, `idaluno` = $idAluno, `nota` = $nota WHERE `idavaliacaoaluno` = $idAvaliacaoAluno";
    $resultado = updateRegistro($sqlUpAvaliacaoAluno);
    
    echo $resultado;    
}

echo "<br><br><button onclick='document.location.replace(`./indexAvaliacaoAluno.php`)'>Voltar</button>";
?>