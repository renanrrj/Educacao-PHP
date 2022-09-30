<?php # COMPLETO
require_once '../mysql.php';
// $idMateria = $_POST['Id_Materia']; # addslashes -> Bloqueia ataque de sqlInject
$dsMateria = $_POST['dsmateria']; # md5-> Criptografa a senha e tira retorno

//* TESTANDO SE O NOME DE DISCIPLINA PASSADO JÁ EXISTE
$sqlMateria = "SELECT * FROM materia where dsmateria = '$dsMateria'";  
$listadsMateria = selectRegistros($sqlMateria);
        
$validado = true;

if($listadsMateria != [] ){
    $validado = false;
    echo 'Inserção nao permitida';
}

//* CRIANDO ID
$idMateria = 1;
$idLivre = false;
while($idLivre == false){
    $sqlIdMateria = "SELECT * FROM materia WHERE idmateria = $idMateria";
    $resultadoIdMateria = selectRegistros($sqlIdMateria);

    if($resultadoIdMateria == []){
        $idLivre = true;
    }else{
        $idMateria++;
    }
}

//* INSERINDO DADO
if($validado){
    $sqlInAluno = "INSERT INTO `materia`(`idmateria`,`dsmateria`) VALUES($idMateria,'$dsMateria')";
    $resultado = insereRegistro($sqlInAluno);
    
    echo $resultado;
}
?>

