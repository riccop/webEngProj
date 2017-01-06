<?php
//ir ao ficheiro XML, encontrar o professor e alterar os dados lá no XML
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';

$codigoAnterior=$_REQUEST['codigoAnterior'];
$codigoNovo=$_REQUEST['codigo'];
$departamento=$_REQUEST['departamento'];
$nome=$_REQUEST['nome'];
$email=$_REQUEST['email'];


$professorExists=false;
     $query = $bd->query("SELECT codProf FROM professor WHERE codProf='".$codigoNovo."'");
     while ($linha = $query->fetch()){
                if($linha['codProf']==$codigoNovo){
                    $professorExists=true;
                }
        }
if($professorExists==false){
	$query2 = $bd->query("UPDATE professor SET ".
	"codProf='".$_REQUEST['codigo']."', ".
	"nome='".$_REQUEST['nome']."', ".
	"departamento='".$_REQUEST['departamento']."', ".
	"email='".$_REQUEST['email']."' ".
	"WHERE codProf='".$_REQUEST['codigoAnterior']."'"
	);
	$professor = $query2->fetch();
		 echo "<p>".$_REQUEST['nome']." adicionado com sucesso.</p>";
		 echo "<table style='text-align:center;'>".
  "<tr><th>Código</th><th>Nome</th>".
  "<th>Departamento</th><th>Email</th></tr>"; 
		 echo "<tr><td>".$_REQUEST['codigo']."</td>";
                echo "<td>".$_REQUEST['nome']."</td>";
                echo "<td>".$_REQUEST['departamento']."</td>";
                echo "<td>".$_REQUEST['email']."</td>";
                echo "</tr>";
         echo "</table><br/>";
         
          echo "<p>".$_REQUEST['nome']." alterado com sucesso.</p>";
          echo "<address><a href='pagPrincipalProfs.html'>Voltar ao início</a></address>";
    }
else{
    echo "<p>O professor com o código ".$codigoNovo." já existe, por favor adicione de novo</p>";
    echo "<address><a href='alterarProf.html'>Voltar ao formulário</a></address>";
}
 
?>