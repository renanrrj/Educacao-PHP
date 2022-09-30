<?php
require_once '../mysql.php';

$idAluno = $_POST['idAluno'];
$login = addslashes($_POST['login']); # addslashes -> Bloqueia ataque de sqlInject
$senha = $_POST['senha']; # md5-> Criptografa a senha e tira retorno

if(is_numeric($idAluno) && $login != "" && $senha != "")
{
    $senha = md5($senha);
    $sqlAluno = "SELECT idaluno FROM aluno where idaluno = $idAluno";  
    $listaidAlunos = selectRegistros($sqlAluno);
    
    
    $sqlLogin = "SELECT dslogin FROM login where dslogin = '$login'";  
    $listaLogin = selectRegistros($sqlLogin);
    
    $validado = true;
    
    //! VERIFICA SE EXISTE ALGUM ALUNO COM ESSE ID, É NECESSÁRIO QUE EXISTA
    //! VERIFICA SE EXISTE ALGUM USUÁRIO COM ESSE LOGIN, NÃO PODE EXISTIR
    if($listaidAlunos == [] || $listaLogin != []){
        $validado = false;
        echo 'Inserção nao permitida';
    }
    if($validado){
        $sqlInAluno = "INSERT INTO `login` VALUES('$login', '$senha', $idAluno)";
        $resultado = insereRegistro($sqlInAluno);
        
        echo $resultado;
    }
}else{
    echo 'Dados inválidos, verifique os dados inseridos!';
}
?>