<?php
require_once '../mysql.php';

$idMateria = $_POST['IdMateria'];
$idAvaliacao = $_POST['IdAvaliacao'];
$descricao = addslashes ($_POST['DEScricao']);

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