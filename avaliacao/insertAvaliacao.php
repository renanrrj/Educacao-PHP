<?php
 require_once '../mysql.php';

$idMateria = addslashes ($_POST['Id_Materia']);
$idAvaliacao = addslashes($_POST['Id_Avaliacao']);
$descricao = addslashes ($_POST['descricao']);

if(is_numeric($idAvaliacao))
{
    $sqlAvaliacao = "SELECT idavaliacao FROM avaliacao where idavaliacao = $idAvaliacao";  
    $listaidAlunos = selectRegistros($sqlAvaliacao);

    $sqlinAvaliacao = "INSERT INTO `avaliacao` VALUES ('$descricao', '$idMateria', '$idAvaliacao')";
    $resultado = insereRegistro($sqlinAvaliacao);

    echo $resultado;
}




?>