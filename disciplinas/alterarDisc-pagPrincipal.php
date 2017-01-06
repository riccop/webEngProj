<?php
//ir ao ficheiro XML, encontrar o disciplina e alterar os dados lá no XML
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
$codigoAnterior=$_REQUEST['codigoAnterior'];
$codigoNovo=$_REQUEST['codigo'];
$curso=$_REQUEST['curso'];
$designacao=$_REQUEST['designacao'];
$ano=$_REQUEST['ano'];

$disciplinaExists=false;
if($codigoAnterior!=$codigoNovo)
{
     $query = $bd->query("SELECT codUC FROM disciplina WHERE codUC='".$codigoNovo."'");
     while ($linha = $query->fetch()){
                if($linha['codUC']==$codigoNovo){
                    $disciplinaExists=true;
                }
        }
}
if($disciplinaExists==false){
	$query2 = $bd->query("UPDATE disciplina SET ".
	"codUC='".$_REQUEST['codigo']."', ".
	"designacao='".$_REQUEST['designacao']."', ".
	"curso='".$_REQUEST['curso']."', ".
	"ano='".$_REQUEST['ano']."' ".
	"WHERE codUC='".$_REQUEST['codigoAnterior']."'"
	);
	$disciplina = $query2->fetch();
		echo "<table style='text-align:center;'>".
           "<tr><th>Código</th><th>Designacao</th>".
           "<th>Curso</th><th>Ano</th></tr>"; 
		   echo "<tr><td>".$_REQUEST['codigo']."</td>";
           echo "<td>".$_REQUEST['designacao']."</td>";
           echo "<td>".$_REQUEST['curso']."</td>";
           echo "<td>".$_REQUEST['ano']."</td>";
           echo "</tr>";
           echo "</table><br/>";
         
          echo "<p>".$_REQUEST['designacao']." alterado com sucesso.</p>";
          echo "<address><a href='pagPrincipalDiscs.html'>Voltar ao início</a></address>";
    }
else{
    echo "<p>A disciplina com o código ".$codigoNovo." já existe, por favor adicione de novo</p>";
    echo "<address><a href='alterarDisc.html'>Voltar ao formulário</a></address>";
}
 
?>