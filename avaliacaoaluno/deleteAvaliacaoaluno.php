<?php # COMPLETO
require_once '../mysql.php';

$idAluno = $_POST['idAluno'];   
$validado = true;

$listaAlunos = [];
if(!is_numeric($idAluno))
{
    $validado = false;
}
else
{
    $sqlAluno = "SELECT idaluno FROM aluno where idaluno = $idAluno";  
    $listaAlunos = selectRegistros($sqlAluno);
}

//! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
if($listaAlunos == [])
{
    $validado = false;
    echo 'Edição não permitida';
}
if($validado)
{
    $sqlDelAluno = "DELETE FROM `aluno` WHERE `idaluno` = $idAluno";
    $resultado = deleteRegistro($sqlDelAluno);
    
    echo $resultado;    
}
else
{
    echo 'Dados inválidos, verifique os dados inseridos!';
}