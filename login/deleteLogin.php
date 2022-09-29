<?php
require_once '../mysql.php';

$login = addslashes($_POST['login']); # addslashes -> Bloqueia ataque de sqlInject

$sqlLogin = "SELECT dslogin FROM login where dslogin = '$login'";
$listaLogin = selectRegistros($sqlLogin);
$validado = true;

//! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
if ($listaLogin == []) {
    $validado = false;
    echo 'Exclusão não permitida';
}

if ($validado) {
    $sqlDelAluno = "DELETE FROM `login` WHERE `dslogin`='$login'";
    $resultado = deleteRegistro($sqlDelAluno);

    echo $resultado;
}
