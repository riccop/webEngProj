<?php

$b=$_REQUEST['d'];
    $rstring = "Nº de submissões Total:";
    if (($b) == 'Escolher aluno') {
    echo "Selecione um aluno";
            alert('Selecione o aluno');
        } else {
            	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
                $query = $bd->query("SELECT A.* FROM projeto_submissao PS, projeto_aluno PA, aluno A WHERE PS.codProj=PA.codProj and PA.codAluno=A.codAluno and A.codAluno='".$b."'");
                $rstring .=numeroDeLinhas($query)." e este ano:";
                $ano=date('Y');
                $query = $bd->query("SELECT A.* FROM projeto_aluno PA, aluno A, projeto_submissao PS, enunciado E, disciplina D WHERE PS.codProj=PA.codProj and PA.codAluno=A.codAluno and A.codAluno='".$b."' and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
                $rstring .=numeroDeLinhas($query);
                echo $rstring;
 }
 
 function numeroDeLinhas($a)
{
    if($a==null || $a==false)
    {
        return 0;
    }
    else
    {
    $i=0;
    while ($linha = $a->fetch()){
        $i++;
    }
    
return $i;
}
}

 ?>