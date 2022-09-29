<?php
    require_once 'mysql.php';

    $nmaluno = addslashes($_POST['nmaluno']);

    $sqlInAluno = "INSERT INTO `aluno`('nmaluno') VALUES('$nmaluno'";
    $resultado = insereRegistro($sqlInAluno);

    echo $resultado;
?>