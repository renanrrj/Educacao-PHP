<?php
    require_once '../mysql.php';

    $idAluno = $_POST['idAluno'];
    $idAvaliacao = $_POST['idAvaliacao'];
    $nota = $_POST['nota'];

    $validado = true;
    $listaAluno = [];
    $listaAvaliacao = [];

    //^ VERIFICANDO SE OS ids SÃO NÚMEROS ANTES DE FAZER O SELECT
    if(is_numeric($idAluno) && is_numeric($idAvaliacao)){
        $sqlAluno = "SELECT * FROM aluno where idaluno = $idAluno";
        $listaAluno = selectRegistros($sqlAluno);
    
        $sqlAvaliacao = "SELECT * FROM avaliacao where idavaliacao = $idAvaliacao";
        $listaAvaliacao = selectRegistros($sqlAvaliacao);
    }else{
        $validado = false;
        echo 'Verifique o aluno e a avaliação escolhidos e tente novamente!<br>';
    }

    //^ VERIFICANDO SE FOI ENCONTRADO O ALUNO ESCOLHIDO
    if($listaAluno == []){
        $validado = false;
        echo 'Inserção não permitida, o aluno escolhido não foi encontrado!<br>';
    }
    
    //^ VERIFICANDO SE FOI ENCONTRADO A AVALIAÇÃO ESCOLHIDA
    if($listaAvaliacao == []){
        $validado = false;
        echo 'Inserção não permitida, a avaliação escolhida não foi encontrada!<br>';
    }
    
    //^ VERIFICANDO SE A NOTA DIGITADA É UM NÚMERO E SE ESTÁ ENTRE 0 E 10
    if(is_numeric($nota) == false || $nota > 10 || $nota < 0){
        $validado = false;
        echo 'Inserção nao permitida, nota inválida';
    }

    //* CRIANDO ID
    $idAvaliacaoAluno = 1;
    $idLivre = false;
    while($idLivre == false){
        $sqlIdAvaliacaoAluno = "SELECT * FROM avaliacaoaluno WHERE `idavaliacaoaluno` = $idAvaliacaoAluno";
        $resultadoIdAvaliacaoAluno = selectRegistros($sqlIdAvaliacaoAluno);

        if($resultadoIdAvaliacaoAluno == []){
            $idLivre = true;
        }else{
            $idAvaliacaoAluno++;
        }
    }
    
    //* INSERINDO DADO
    if($validado){
        $sqlInAvaliacaoAluno = "INSERT INTO `avaliacaoaluno`(`idavaliacaoaluno`, `idavaliacao`,`idaluno`,`nota`) VALUES($idAvaliacaoAluno, $idAvaliacao, $idAluno, $nota)";
        $resultado = insereRegistro($sqlInAvaliacaoAluno);
        
        echo $resultado;
    }

 echo "<br><br><button onclick='document.location.replace(`./indexAvaliacaoAluno.php`)'>Voltar</button>";
?>