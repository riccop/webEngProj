<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	
	
$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['disc'];
}
if($form=="f2"){
$codigo=$_REQUEST['discLista'];
}

    $query = $bd->query("SELECT * FROM disciplina WHERE codUC='".$codigo."'");
$codUC="";
$designacao="";
$curso="";
$ano="";
$codProf="";

 while ($linha = $query->fetch()){
                $codUC=$linha['codUC'];
                $designacao=$linha['designacao'];
                $curso=$linha['curso'];
                $ano=$linha['ano'];
                $codProf=$linha['codProf'];
        }        
        echo "<h1>Estatisticas gerais das Disciplinas e da Disciplina ".$designacao."</h1>";

    echo "<table border='1' style='text-align:center;'>".
  "<tr><th>Instrução</th><th>Total</th><th>Este ano</th></tr>";
       
      //##############################################Nº de alunos TOTAL################################################
//nº de alunos total
     $query = $bd->query("SELECT * FROM aluno A, projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE D.codUC='".$codUC."' and D.codUC=E.codUC and E.codEnunciado=PS.codEnunciado and PS.codProj=PA.codProj and PA.codAluno=A.codAluno");
     $alunosTotal=numeroDeLinhas($query);
     
     $ano=date('Y');
     $query = $bd->query("SELECT * FROM aluno A, projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE D.codUC='".$codUC."' and D.codUC=E.codUC and E.codEnunciado=PS.codEnunciado and PS.codProj=PA.codProj and PA.codAluno=A.codAluno and D.ano='".$ano."'");
     $alunosAno=numeroDeLinhas($query);
    
    
     echo "<tr><td>Nº de Alunos:</td><td>".$alunosTotal."</td><td>".$alunosAno."</td></tr>"; 
        
    //##############################################Nº de enunciados################################################
//nº de alunos total
     $query = $bd->query("SELECT E.* FROM enunciado E, disciplina D where E.codUC=D.codUC");
     $enunTOTAL=numeroDeLinhas($query);
     
//nº de alunos ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT E.* FROM enunciado E, disciplina D where E.codUC=D.codUC and D.ano='".$ano."'");
     $enunANO=numeroDeLinhas($query);

     echo "<tr><td>Nº de Enunciados lançados:</td><td>".$enunTOTAL."</td><td>".$enunANO."</td></tr>"; 
    
        
    //##############################################Nº de Project-Record submetidos################################################
//nº de Project-Record total
     $query = $bd->query("SELECT PS.* FROM projeto_submissao PS, enunciado E WHERE PS.codEnunciado=E.codEnunciado and E.codUC='".$codUC."'");
     $PRTotal=numeroDeLinhas($query);
     
//nº de Project-Record ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT PS.* FROM projeto_submissao PS, enunciado E WHERE PS.codEnunciado=E.codEnunciado and E.codUC='".$codUC."' and D.ano='".$ano."'");
     $PRAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Project-Records inseridos:</td><td>".$PRTotal."</td><td>".$PRAno."</td></tr>"; 
        
        
    //##############################################Nº de ficheiros geral################################################
//nº de ficheiros total
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS, enunciado E WHERE F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC='".$codUC."'");
     $fichTotal=numeroDeLinhas($query);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS, enunciado E WHERE F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC='".$codUC."' and D.ano='".$ano."'");
     $fichAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Ficheiros Assossiados:</td><td>".$fichTotal."</td><td>".$fichAno."</td></tr>";
      
      
     //##############################################Aluno com +/- disciplinas################################################

    $query16 = $bd->query("SELECT codAluno, COUNT(codAluno) AS popularity FROM projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC GROUP BY codProf ORDER BY popularity DESC limit 1;");
     $alunoMaisdisc =array();
     while ($linha = $query16->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($alunoMaisdisc, $linha);
        } 
       
       echo "<tr><td>Aluno(s) com mais disciplinas:</td><td>";
        
        foreach($alunoMaisdisc as $p)
        {
            $query17 = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$p."'");
            echo $query17->fetch()."<br/>";
        }
        echo "</td></tr>";
     
//prof com menos disciplinas
     $query18 = $bd->query("SELECT codAluno, COUNT(codAluno) AS popularity FROM projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC GROUP BY codProf ORDER BY popularity limit 1;");
     $alunoMenosdisc =array();
     while ($linha = $query18->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($alunoMenosdisc, $linha);
        } 
       
       echo "<tr><td>Aluno(s) com menos disciplinas:</td><td>";
        
        foreach($alunoMenosdisc as $p)
        {
            $query19 = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$p."'");
            echo $query19->fetch()."<br/>";
        }
        echo "</td></tr>";
     

    //##############################################FIM################################################
    
    //##############################################Aluno com +/- disciplinas ESTE ANO################################################

         $ano=date('Y');//devolve o ano atual
    $query16 = $bd->query("SELECT codAluno, COUNT(codAluno) AS popularity FROM projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."' GROUP BY codProf ORDER BY popularity DESC limit 1;");
     $alunoMaisdisc =array();
     while ($linha = $query16->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($alunoMaisdisc, $linha);
        } 
       
       echo "<tr><td>Aluno(s) com mais disciplinas este ano:</td><td>";
        
        foreach($alunoMaisdisc as $p)
        {
            $query17 = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$p."'");
            echo $query17->fetch()."<br/>";
        }
        echo "</td></tr>";
     
//prof com menos disciplinas

     $query18 = $bd->query("SELECT codAluno, COUNT(codAluno) AS popularity FROM projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D WHERE PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."' GROUP BY codProf ORDER BY popularity limit 1;");
     $alunoMenosdisc =array();
     while ($linha = $query18->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($alunoMenosdisc, $linha);
        } 
       
       echo "<tr><td>Aluno(s) com menos disciplinas este ano:</td><td>";
        
        foreach($alunoMenosdisc as $p)
        {
            $query19 = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$p."'");
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