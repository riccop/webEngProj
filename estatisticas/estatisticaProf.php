<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	
	$codigo=$_REQUEST['profLista'];

    $query = $bd->query("SELECT * FROM professor WHERE codProf='".$codigo."'");
$codProf="";
$nome="";
$email="";
$departamento="";

 while ($linha = $query->fetch()){
                $codProf=$linha['codProf'];
                $nome=$linha['nome'];
                $email=$linha['email'];
                $departamento=$linha['departamento'];
        }        
        echo "<h1>Estatisticas gerais dos Professores e do Professor ".$nome."</h1>";

    echo "<table border='1' style='text-align:center;'>".
  "<tr><th>Instrução</th><th>Total</th><th>Este ano</th></tr>";
       
      //##############################################Nº de professores TOTAL################################################
//nº de alunos total
     $query = $bd->query("SELECT * FROM professor");
     $profsTotal=numeroDeLinhas($query);
     

     echo "<tr><td>Nº de Professores (GERAL):</td><td>".$profsTotal."</td><td>-</td></tr>"; 
        
    //##############################################Nº de professores a lecionar################################################
//nº de alunos total
     $query2 = $bd->query("SELECT P.* FROM professor P, disciplina D where P.codProf=D.codProf");
     $profsLecionamTotal=numeroDeLinhas($query2);
     
//nº de alunos ano
     $ano=date('Y');//devolve o ano atual
     $query3 = $bd->query("SELECT P.* FROM professor P, disciplina D where P.codProf=D.codProf and D.ano='".$ano."'");
     $profsAno=numeroDeLinhas($query3);

     echo "<tr><td>Nº de professores a leccionar:</td><td>".$profsLecionamTotal."</td><td>".$profsAno."</td></tr>"; 
    
        
    //##############################################Nº de disciplinas lecccionadas GERAL################################################
//nº de Project-Record total
     $query4 = $bd->query("SELECT * FROM disciplinas");
     $discTotal=numeroDeLinhas($query4);
     
//nº de Project-Record ano
     $ano=date('Y');//devolve o ano atual
     $query5 = $bd->query("SELECT * FROM disciplina D where D.ano='".$ano."'");
     $discAno=numeroDeLinhas($query5);

     echo "<tr><td>Nº de disciplinas leccionadas (GERAL):</td><td>".$discTotal."</td><td>".$discAno."</td></tr>"; 
        
     //##############################################Nº de disciplinas lecccionadas pelo Professor################################################
//nº de Project-Record total
     $query6 = $bd->query("SELECT D.* FROM disciplina D WHERE D.codProf='".$codProf."'");
     $discProfTotal=numeroDeLinhas($query6);
     
//nº de Project-Record ano
     $ano=date('Y');//devolve o ano atual
     $query7 = $bd->query("SELECT D.* FROM disciplina D WHERE D.codProf='".$codProf."' and D.ano='".$ano."'");
     $discProfAno=numeroDeLinhas($query7);

     echo "<tr><td>Nº de disciplinas lecccionadas pelo Professor:</td><td>".$discProfTotal."</td><td>".$discProfAno."</td></tr>"; 
        
    //##############################################Numero de alunos inscritos em disciplinas lecionadas pelo Prof################################################
//nº de ficheiros total
     $query8 = $bd->query("SELECT A.* FROM aluno A, projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D, professor P WHERE P.codProf='".$codProf."' and P.codProf=D.codProf and D.codUC=E.codUC and E.codProj=PS.codProj and PS.codProj=PA.codProf and PA.codAluno=A.codAluno");
     $alunosTotal=numeroDeLinhas($query8);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query9 = $bd->query("SELECT A.* FROM aluno A, projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D, professor P WHERE P.codProf='".$codProf."' and P.codProf=D.codProf and D.codUC=E.codUC and E.codProj=PS.codProj and PS.codProj=PA.codProf and PA.codAluno=A.codAluno and D.ano='".$ano."'");
     $alunosAno=numeroDeLinhas($query9);

     echo "<tr><td>Nº de alunos inscritos em disciplinas lecionadas pelo Professor:</td><td>".$alunosTotal."</td><td>".$alunosAno."</td></tr>";
      
    //##############################################Nº de Enunciados lançados################################################
//nº de ficheiros total
     $query10 = $bd->query("SELECT E.* FROM enunciado E, disciplina D, professor P WHERE E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."'");
     $enunTotal=numeroDeLinhas($query10);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query11 = $bd->query("SELECT E.* FROM enunciado E, disciplina D, professor P WHERE E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."' and D.ano='".$ano."'");
     $enunAno=numeroDeLinhas($query11);

     echo "<tr><td>Nº de Enunciados lançados pelo professor:</td><td>".$enunTotal."</td><td>".$enunAno."</td></tr>"; 
            
     //##############################################Nº de PR assossiados ao prof################################################
//nº de disciplinas total
     $query12 = $bd->query("SELECT PS.* FROM projeto_submissao PS, enunciado E, disciplina D, professor P WHERE PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."'");
     $PRassossiadosTotal=numeroDeLinhas($query12);
     
//nº de disciplinas ano
     $ano=date('Y');//devolve o ano atual
     $query13 = $bd->query("SELECT PS.* FROM projeto_submissao PS, enunciado E, disciplina D, professor P WHERE PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."' and D.ano='".$ano."'");
     $PRassossiadosAno=numeroDeLinhas($query13);

     echo "<tr><td>Nº de PR assossiados ao Professor:</td><td>".$PRassossiadosTotal."</td><td>".$PRassossiadosAno."</td></tr>";
      
      
      //##############################################Nº de Ficheiros associados ao Professor################################################
//nº de ficheiros total
     $query14 = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS, enunciado E, disciplina D, professor P WHERE F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."'");
     $fichTotal=numeroDeLinhas($query14);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query15 = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS, enunciado E, disciplina D, professor P WHERE F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.codProf=P.codProf and P.codProf='".$codProf."' and D.ano='".$ano."'");
     $fichAno=numeroDeLinhas($query15);

     echo "<tr><td>Nº de Ficheiros associados ao Professor:</td><td>".$fichTotal."</td><td>".$fichAno."</td></tr>"; 
            
     //##############################################Professor com mais Disciplinas################################################
//prof com mais disciplinas
     $query16 = $bd->query("SELECT codProf, COUNT(codProf) AS popularity FROM disciplina GROUP BY codProf ORDER BY popularity DESC limit 1;");
     $profMaisdisc =array();
     while ($linha = $query16->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($profMaisdisc, $linha);
        } 
       
       echo "<tr><td>Professor(es) com mais disciplinas:</td><td>";
        
        foreach($profMaisdisc as $p)
        {
            $query17 = $bd->query("SELECT nome FROM professor WHERE codProf='".$p."'");
            echo $query17->fetch()."<br/>";
        }
        echo "</td></tr>";
     
//prof com menos disciplinas
     $query18 = $bd->query("SELECT codProf, COUNT(codProf) AS popularity FROM disciplina GROUP BY codProf ORDER BY popularity limit 1;");
     $profMenosdisc =array();
     while ($linha = $query18->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($profMenosdisc, $linha);
        } 
       
       echo "<tr><td>Professor(es) com menos disciplinas:</td><td>";
        
        foreach($profMenosdisc as $p)
        {
            $query19 = $bd->query("SELECT nome FROM professor WHERE codProf='".$p."'");
            echo $query19->fetch()."<br/>";
        }
        echo "</td></tr>";
     

    //##############################################FIM################################################
    
    
echo "</table>";
 echo "<address><a href='pagPrincipalEstatisticas.html'>Voltar ao início</a></address>";
 
 
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