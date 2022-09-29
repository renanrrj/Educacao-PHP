<?php
require_once '../mysql.php';

$idAmatriculado = $_POST['idAlunosmatric'];

$validado = true;
$listaAvaliacao = [];
if(!is_numeric($idAmatriculado))
{
    $validado = false;
}
else
{
    $sqlidAmatriculado = "SELECT idalunomatriculado FROM alunomatriculado where idAlunomatriculado = $idAmatriculado"; 
    $listaidAmatriculado = selectRegistros($sqlidAmatriculado);
}

if($listaAvaliacao=[])
{
    $validado=false;
    echo "edição nao permitida";
}
if($validado)
{
    $sqldelAmatriculado = "DELETE FROM `alunomatriculado` WHERE `idalunomatriculado` = $idAmatriculado";
    $resultado = deleteRegistro($sqldelAmatriculado);

    echo $resultado;
}
else
{
    echo "dados inválidos";
}
?>