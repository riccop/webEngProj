<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $discTotal=0;
    $discAno=0;
    $discMedia=0;
    $alunoTotal=0;
    $alunoAno=0;
    $enunTotal=0;
    $enunAno=0;
    $PRTotal=0;
    $PRAno=0;
    $fichTotal=0;
    $fichAno=0;
    $fichDisc=0;
    $profTotal=0;
    $profAno=0;
    echo "<h1>Estatisticas Gerais</h1>";

    echo "<table border='1' style='text-align:center;'>".
  "<tr><th>Instrução</th><th>Total</th><th>Este ano</th><th>Média</th></tr>";
       
      //##############################################DISCIPLINAS################################################
//nº de disciplinas total
     $query = $bd->query("SELECT * FROM disciplina");
     $discTotal=numeroDeLinhas($query);
     
//nº de disciplinas ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT * FROM disciplina where ano='".$ano."'");
     $discAno=numeroDeLinhas($query);

//media anual disciplinas
     $query = $bd->query("SELECT MIN(CAST(ano AS UNSIGNED)) FROM disciplina");
     $anoMinimo=$query->fetch();
     $query = $bd->query("SELECT MAX(CAST(ano AS UNSIGNED)) FROM disciplina");
     $anoMaximo=$query->fetch();
     $nAnos=anoMaximo-anoMinimo;
     $query = $bd->query("SELECT COUNT(*) FROM disciplina");
     $nDisciplinas=$query->fetch();
     $discMedia=$nDisciplinas/$nAnos;

     echo "<tr><td>Nº de disciplinas:</td><td>".$discTotal."</td><td>".$discAno."</td><td>Por ano: ".$discMedia."</td></tr>"; 
        
    //##############################################ALUNOS################################################
//nº de alunos total
     $query = $bd->query("SELECT * FROM aluno");
     $alunoTotal=numeroDeLinhas($query);
     
//nº de alunos ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT A.* FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $alunoAno=numeroDeLinhas($query);

//media anual alunos
     $query = $bd->query("SELECT MIN(CAST(D.ano AS UNSIGNED)) FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $anoMinimo=$query->fetch();
     $query = $bd->query("SELECT MAX(CAST(D.ano AS UNSIGNED)) FROM aluno A,projeto_aluno PA, projeto_submissao PS, enunciado E, disciplina D where A.codAluno=PA.codAluno and PA.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $anoMaximo=$query->fetch();
     $nAnos=anoMaximo-anoMinimo;
     $query = $bd->query("SELECT COUNT(*) FROM aluno");
     $nAlunos=$query->fetch();
     $alunosMedia=$nAlunos/$nAnos;

     echo "<tr><td>Nº de alunos:</td><td>".$alunoTotal."</td><td>".$alunoAno."</td><td>Por ano: ".$alunoMedia."</td></tr>"; 
        
    //##############################################Enunciados################################################
//nº de enunciados total
     $query = $bd->query("SELECT * FROM enunciado");
     $enunTotal=numeroDeLinhas($query);
     
//nº de enunciados ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT E.* FROM enunciado E, disciplina D where E.codUC=D.codUC and D.ano='".$ano."'");
     $enunAno=numeroDeLinhas($query);

//media anual enunciados
     $query = $bd->query("SELECT MIN(CAST(D.ano AS UNSIGNED)) FROM enunciado E, disciplina D where E.codUC=D.codUC");
     $anoMinimo=$query->fetch();
     $query = $bd->query("SELECT MAX(CAST(D.ano AS UNSIGNED)) FROM enunciado E, disciplina D where E.codUC=D.codUC");
     $anoMaximo=$query->fetch();
     $nAnos=anoMaximo-anoMinimo;
     $query = $bd->query("SELECT COUNT(*) FROM enunciado");
     $nEnun=$query->fetch();
     $enunMedia=$nEnun/$nAnos;

     echo "<tr><td>Nº de enunciados:</td><td>".$enunTotal."</td><td>".$enunAno."</td><td>Por ano: ".$enunMedia."</td></tr>"; 
        
    //##############################################Project-Record################################################
//nº de enunciados total
     $query = $bd->query("SELECT * FROM projeto_submissao");
     $PRTotal=numeroDeLinhas($query);
     
//nº de enunciados ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT PS.* FROM projeto_submissao PS,enunciado E, disciplina D where PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $PRAno=numeroDeLinhas($query);

//media anual enunciados
     $query = $bd->query("SELECT MIN(CAST(D.ano AS UNSIGNED)) FROM projeto_submissao PS, enunciado E, disciplina D where PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $anoMinimo=$query->fetch();
     $query = $bd->query("SELECT MAX(CAST(D.ano AS UNSIGNED)) FROM projeto_submissao PS, enunciado E, disciplina D where PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC");
     $anoMaximo=$query->fetch();
     $nAnos=anoMaximo-anoMinimo;
     $query = $bd->query("SELECT COUNT(*) FROM projeto_submissao");
     $nPR=$query->fetch();
     $PRMedia=$nPR/$nAnos;

     echo "<tr><td>Nº de Project-Records:</td><td>".$PRTotal."</td><td>".$PRAno."</td><td>Por ano: ".$PRMedia."</td></tr>"; 
        
    //##############################################Professores################################################
//nº de enunciados total
     $query = $bd->query("SELECT * FROM professor");
     $profTotal=numeroDeLinhas($query);
     
//nº de enunciados ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT P.* FROM professor P, disciplina D where P.codProf=D.codProf and D.ano='".$ano."'");
     $profAno=numeroDeLinhas($query);

//media anual enunciados
     $query = $bd->query("SELECT MIN(CAST(D.ano AS UNSIGNED)) FROM professor P, disciplina D where P.codProf=D.codProf");
     $anoMinimo=$query->fetch();
     $query = $bd->query("SELECT MAX(CAST(D.ano AS UNSIGNED)) FROM professor P, disciplina D where P.codProf=D.codProf");
     $anoMaximo=$query->fetch();
     $nAnos=anoMaximo-anoMinimo;
     $query = $bd->query("SELECT COUNT(*) FROM professor");
     $nProf=$query->fetch();
     $profMedia=$nProf/$nAnos;

     echo "<tr><td>Nº de Professores:</td><td>".$profTotal."</td><td>".$profAno."</td><td>Por ano: ".$profMedia."</td></tr>"; 
        
    //##############################################FICHEIROS################################################
//nº de enunciados total
     $query = $bd->query("SELECT * FROM ficheiro");
     $fichTotal=numeroDeLinhas($query);
     
//nº de enunciados ano
     $ano=date('Y');//devolve o ano atual
     $query = $bd->query("SELECT F.* FROM ficheiro F, projeto_submissao PS,enunciado E, disciplina D where F.codProj=PS.codProj and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
     $fichAno=numeroDeLinhas($query);

//media anual enunciados
     $query = $bd->query("SELECT COUNT(*) FROM disciplina");
     $nDisciplinas=$query->fetch();
     $query = $bd->query("SELECT COUNT(*) FROM ficheiro");
     $nFich=$query->fetch();
     $fichMedia=$nFich/$nDisciplinas;

     echo "<tr><td>Nº de Ficheiros:</td><td>".$fichTotal."</td><td>".$fichAno."</td><td>Por disciplina: ".$fichMedia."</td></tr>"; 
        
   
    //##############################################FIM DA TABELA################################################
    
    
echo "</table>";

    //#############################################PEDIDOS ESPECIFICOS############################################

    //#######################Nº SUBMISSOES GLOBAL##########################################
    //feito na linha 88
    
    //#######################Nº SUBMISSOES POR ENUNCIADO###################################
    echo " <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>";

    echo " <script type='text/javascript' src='pedidosReal.js'></script>";
    echo "Submissoes por enunciado:";
    
    echo "<select id='enunLista' name='enunLista'></select> ";
        echo "<input type='button' value='Enviar' id='enviar2' onclick=actualizar(enunLista)></input>";

    echo "<div id='submissoesPorEnunciado'>";
    
    
    echo "</div>";
    
    //#######################Nº SUBMISSOES POR ALUNO###################################

    echo "Submissoes por aluno:";
    
    echo "<select id='alunoLista' name='alunoLista'></select> ";
        echo "<input type='button' value='Enviar' id='enviar' onclick=actualizar2(alunoLista)></input>";

    echo "<div id='submissoesPorAluno'>";
    
    
    echo "</div>";
    
    
    
    
     //##############################################FIM DA TABELA################################################

    

 echo "<address><a href='pagPrincipalEstatisticas.html'>Voltar ao início</a></address>";
 
  function actualizar($b)
 {
    $rstring = "Nº de submissões Total:";
    if ($b.val() == 'Escolher aluno') {
            alert('Selecione o aluno');
        } else {
            	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
                $query = $bd->query("SELECT * FROM projeto_submissao PS WHERE PS.codEnunciado='".$b.val()."'");
                $rstring .=numeroDeLinhas($query)." e este ano:";
                $ano=date('Y');
                $query = $bd->query("SELECT * FROM projeto_submissao PS, enunciado E, disciplina D WHERE PS.codEnunciado='".$b.val()."' and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
                $rstring .=numeroDeLinhas($query);
        }
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