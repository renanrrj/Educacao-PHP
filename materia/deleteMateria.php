<?php # Completo
require_once '../mysql.php';

$dsMateria = $_POST['dsmateria'];
$idMateria = $_POST['idmateria'];

$validado = true;

$listaMateria = [];
if(!is_numeric($idMateria))
{
    $validado = false;
}
else
{
    $sqlidMateria = "SELECT idmateria FROM materia where idmateria = $idMateria";
    $listaidMateria = selectRegistros($sqlidMateria);
}

if($listaMateria=[])
{
    $validado=false;
    echo "edição nao permitida";
}
if($validado)
{
    $sqldelMateria = "DELETE FROM `materia` WHERE `idmateria` = $idMateria";
    $resultado = deleteRegistro($sqldelMateria);

    echo $resultado;
}
else
{
    echo "dados inválidos";
}
?>