<?php
require_once '../mysql.php';

$idAvaliacao = $_POST['Id_Avaliacao'];
$validado = true;

$listaAvaliacao = [];
if(!is_numeric($idAvaliacao))
{
    $validado = false;
}
else
{
    $sqlidAvaliacao = "SELECT idavaliacao FROM avaliacao where idavaliacao = $idAvaliacao";
    $listaidAvaliacao = selectRegistros($sqlidAvaliacao);
}

if($listaAvaliacao=[])
{
    $validado=false;
    echo "edição nao permitida";
}
if($validado)
{
    $sqldelAvaliacao = "DELETE FROM `avaliacao` WHERE `idavaliacao` = $idAvaliacao";
    $resultado = deleteRegistro($sqldelAvaliacao);

    echo $resultado;
}
else
{
    echo "dados inválidos";
}
?>