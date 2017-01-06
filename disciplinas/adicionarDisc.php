<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';

    $disciplinaExists=false;
    $profExiste=false;

	   echo "<h1>Adicionar Disciplina</h1>";
//Primeiro é necessário verificar se já existe um Disciplina com o código que vai ser inserido
      $query = $bd->query("SELECT codUC FROM disciplina WHERE codUC='".$_REQUEST['codigo']."'");
     while ($linha = $query->fetch()){
                //echo "Cod Disciplina BD ".$linha['codUC']."";
                if($linha['codUC']==$_REQUEST['codigo']){
                    $disciplinaExists=true;
                    //echo "Encontrei Disciplina!";
                }
        }
        $query2 = $bd->query("SELECT codProf FROM professor WHERE codProf='".$_REQUEST['codProf']."'");
     while ($linha2 = $query2->fetch()){
                //echo "Cod Disciplina BD ".$linha['codUC']."";
                if($linha2['codProf']==$_REQUEST['codProf']){
                    $profExiste=true;
                    //echo "Encontrei Disciplina!";
                }
        }
        
if($profExiste==false)
{
        echo "<p>O Professor com o código ".$_REQUEST['codProf']." não existe, por favor adicione de novo</p>";
        echo "<address><a href='adicionarDisc.html'>Voltar ao formulário</a></address>";
    
}
else
{
    if($disciplinaExists==false){
	   $query = $bd->prepare("INSERT INTO disciplina VALUES (:codUC, :designacao, :curso, :ano, :codProf)");
	       $query->bindValue(":codUC", $_REQUEST['codigo'], PDO::PARAM_STR);
		   $query->bindValue(":designacao", (string)$_REQUEST['designacao'], PDO::PARAM_STR);
		   $query->bindValue(":curso", (string)$_REQUEST['curso'], PDO::PARAM_STR);
		   $query->bindValue(":ano", (string)$_REQUEST['ano'], PDO::PARAM_STR);
		   $query->bindValue(":codProf", (string)$_REQUEST['codProf'], PDO::PARAM_STR);
		   $query->execute();
		   $query->closeCursor();
	       echo "<p>".$_REQUEST['designacao']." adicionado com sucesso.</p>";
		   echo "<table style='text-align:center;'>".
           "<tr><th>Código</th><th>Designacao</th>".
           "<th>Curso</th><th>Ano</th><th>Codigo Professor</th></tr>"; 
		   echo "<tr><td>".$_REQUEST['codigo']."</td>";
           echo "<td>".$_REQUEST['designacao']."</td>";
           echo "<td>".$_REQUEST['curso']."</td>";
           echo "<td>".$_REQUEST['ano']."</td>";
           echo "<td>".$_REQUEST['codProf']."</td>";
           echo "</tr>";
           echo "</table><br/>";
        }
    else{
        echo "<p>A Disciplina com o código ".$_REQUEST['codigo']." já existe, por favor adicione de novo</p>";
        echo "<address><a href='adicionarDisc.html'>Voltar ao formulário</a></address>";
    }
}
 echo "<address><a href='pagPrincipalDiscs.html'>Voltar ao início</a></address>";

?>