<?php
require_once '../mysql.php';

$idAluno = $_POST['Id_Aluno'];
$login = addslashes($_POST['login']); # addslashes -> Bloqueia ataque de sqlInject
$senha = md5($_POST['senha']); # md5-> Criptografa a senha e tira retorno

if(is_numeric($idAluno)){
    $sqlAluno = "SELECT idaluno FROM aluno where idaluno = $idAluno";  
    $listaAlunos = selectRegistros($sqlAluno);
    
    
    $sqlLogin = "SELECT dslogin FROM login where dslogin = '$login'";  
    $listaLogin = selectRegistros($sqlLogin);
    
    $validado = true;
    
    //! VERIFICA SE EXISTE ALGUM ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
    //! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, É NECESSÁRIO QUE EXISTA
    if($listaAlunos == [] || $listaLogin == []){
        $validado = false;
        echo 'Edição não permitida';
    }

    if($validado){
        $sqlUpAluno = "UPDATE `login` SET `dssenha` = '$senha', `idaluno` = $idAluno WHERE `dslogin` = '$login'";
        $resultado = updateRegistro($sqlUpAluno);
        
        echo $resultado;
    }
}else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}
?>