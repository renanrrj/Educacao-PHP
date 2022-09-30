<?php # COMPLETO
 require_once '../mysql.php';

$idMateria = $_POST['IdMateria'];
$idAvaliacao = $_POST['IdAvaliacao'];
$descricao = addslashes ($_POST['DEScricao']);

$sqlAvaliacao = "SELECT * FROM avaliacao where dsavaliacao";  
$listadsAvaliacao = selectRegistros($sqlAvaliacao);

$validado = true;

if($listadsAvaliacao == [] ){
    $validado = false;
    echo 'Inserção nao permitida';
}

//* CRIANDO ID
$idAvaliacao = 1;
$idLivre = false;
while($idLivre == false){
    $sqlidAvaliacao = "SELECT idavaliacao FROM avaliacao where idavaliacao = $idAvaliacao";
    $resultadoIdAvaliacao = selectRegistros($sqlidAvaliacao);

    if($resultadoIdAvaliacao == []){
        $idLivre = true;
    }else{
        $idAvaliacao++;
    }
}

if($validado){
    $sqlInAluno = "INSERT INTO `avaliacao`(`idmateria`, `dsavaliacao`, `idavaliacao`) VALUES( $idAvaliacao,'$descricao', $idMateria)";
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;}

?>