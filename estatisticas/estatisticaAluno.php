<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	
	$codigo=$_REQUEST['alunoLista'];

    $query = $bd->query("SELECT * FROM aluno WHERE codAluno='".$codigo."'");
$codAluno="";
$nome="";
$email="";

 while ($linha = $query->fetch()){
                $codAluno=$linha['codAluno'];
                $nome=$linha['nome'];
                $email=$linha['email'];
        }        
        echo "<h1>Estatisticas gerais dos Alunos e do Aluno ".$nome."</h1>";

    echo "<table border='1' style='text-align:center;'>".
  "<tr><th>Instrução</th><th>Total</th><th>Este ano</th></tr>";
       
      //##############################################Nº de alunos TOTAL################################################
//nº de alunos total
     $query = $bd->query("SELECT * FROM aluno");
     $alunosTotal=numeroDeLinhas($query);
     

     echo "<tr><td>Nº de Alunos:</td><td>".$alunosTotal."</td><td>-</td></tr>"; 
        
    //##############################################Nº de alunos inscritos################################################
//nº de alunos total
     $query = $bd->query("SELECT A.* FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $alunoInscritoTotal=numeroDeLinhas($query);
     
//nº de alunos ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT A.* FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $alunoAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de alunos inscritos:</td><td>".$alunoInscritoTotal."</td><td>".$alunoAno."</td></tr>"; 
    
        
    //##############################################Nº de Project-Record inseridos GERAL################################################
//nº de Project-Record total
     $query = $bd->query("SELECT * FROM projeto_submissao");
     $PRTotal=numeroDeLinhas($query);
     
//nº de Project-Record ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT PS.* FROM projeto_submissao PS,enunciado E, disciplina D where PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $PRAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Project-Records inseridos (GERAL):</td><td>".$PRTotal."</td><td>".$PRAno."</td></tr>"; 
        
     //##############################################Nº de Project-Record inseridos pelo Aluno################################################
//nº de Project-Record total
     $query = $bd->query("SELECT PS.* FROM projeto_submissao PS, projeto_aluno PA WHERE PS.codProj=PA.codProj and PA.codAluno='".$codAluno."'");
     $PRAlunoTotal=numeroDeLinhas($query);
     
//nº de Project-Record ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT PS.* FROM projeto_aluno PA, projeto_submissao PS,enunciado E, disciplina D where PS.codProj=PA.codProj and PA.codAluno='".$codAluno."' and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $PRAlunoAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Project-Records inseridos pelo aluno:</td><td>".$PRAlunoTotal."</td><td>".$PRAlunoAno."</td></tr>"; 
        
    //##############################################Nº de ficheiros geral################################################
//nº de ficheiros total
     $query = $bd->query("SELECT * FROM ficheiro");
     $fichTotal=numeroDeLinhas($query);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS,enunciado E, disciplina D where F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $fichAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Ficheiros (GERAL):</td><td>".$fichTotal."</td><td>".$fichAno."</td></tr>";
      
    //##############################################Nº de ficheiros inseridos pelo aluno################################################
//nº de ficheiros total
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS, projeto_aluno PA WHERE PS.codProj=PA.codProj and PA.codAluno='".$codAluno."'");
     $fichAlunoTotal=numeroDeLinhas($query);
     
//nº de ficheiros ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_aluno PA, projeto_submissao PS,enunciado E, disciplina D where PS.codProj=PA.codProj and PA.codAluno='".$codAluno."' and F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $fichAlunoAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de Ficheiros inseridos pelo aluno:</td><td>".$fichAlunoTotal."</td><td>".$fichAlunoAno."</td></tr>"; 
            
     //##############################################Nº de disciplinas inscrito################################################
//nº de disciplinas total
     $query = $bd->query("SELECT D.codUC FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $discTotal=numeroDeLinhas($query);
     
//nº de disciplinas ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT D.codUC FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $discAno=numeroDeLinhas($query);

     echo "<tr><td>Nº de disciplinas inscrito:</td><td>".$discTotal."</td><td>".$discAno."</td></tr>";
      
    
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