<?php
//ir ao ficheiro XML, encontrar o aluno e alterar os dados lá no XML
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
$codigoAnterior=$_REQUEST['codigoAnterior'];
$codigoNovo=$_REQUEST['codigo'];
$nome=$_REQUEST['nome'];
$email=$_REQUEST['email'];

$alunoExists=false;
if($codigoAnterior!=$codigoNovo)
{
     $query = $bd->query("SELECT codAluno FROM aluno WHERE codAluno='".$codigoNovo."'");
     while ($linha = $query->fetch()){
                if($linha['codAluno']==$codigoNovo){
                    $alunoExists=true;
                }
        }
}
if($alunoExists==false){
	$query2 = $bd->query("UPDATE aluno SET ".
	"codAluno='".$_REQUEST['codigo']."', ".
	"nome='".$_REQUEST['nome']."', ".
	"email='".$_REQUEST['email']."' ".
	"WHERE codAluno='".$_REQUEST['codigoAnterior']."'"
	);
	$aluno = $query2->fetch();
		echo "<table style='text-align:center;'>".
           "<tr><th>Código</th><th>Nome</th><th>Email</th></tr>"; 
		   echo "<tr><td>".$_REQUEST['codigo']."</td>";
           echo "<td>".$_REQUEST['nome']."</td>";
           echo "<td>".$_REQUEST['email']."</td>";
           echo "</tr>";
           echo "</table><br/>";
         
          echo "<p>".$_REQUEST['nome']." alterado com sucesso.</p>";
          echo "<address><a href='pagPrincipalAlunos.html'>Voltar ao início</a></address>";
    }
else{
    echo "<p>O aluno com o código ".$codigoNovo." já existe, por favor adicione de novo</p>";
    echo "<address><a href='alterarAluno.html'>Voltar ao formulário</a></address>";
}
 
?>