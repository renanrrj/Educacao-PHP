<?php # COMPLETO
    require_once '../mysql.php';

    $nmAluno = addslashes($_POST['nmaluno']);

    $sqlAluno = "SELECT * FROM aluno where nmaluno = '$nmAluno'";  
    $listanmAluno = selectRegistros($sqlAluno);

    $validado = true;

    if($listanmAluno != [] ){
        $validado = false;
        echo 'Inserção nao permitida';
    }

    //* CRIANDO ID
$idAluno = 1;
$idLivre = false;
while($idLivre == false){
    $sqlIdAluno = "SELECT * FROM aluno WHERE `idaluno` = $idAluno";
    $resultadoIdAluno = selectRegistros($sqlIdAluno);

    if($resultadoIdAluno == []){
        $idLivre = true;
    }else{
        $idAluno++;
    }
}
    //* INSERINDO DADO
if($validado){
    $sqlInAluno = "INSERT INTO `aluno`(`idaluno`, `nmaluno`) VALUES($idAluno, '$nmAluno')";
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;
}

echo "<br><br><button onclick='document.location.replace(`../index.php`)'>Voltar</button>";
?>