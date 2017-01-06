<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
 	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

 $codigoAnterior=$_REQUEST['oldid'];
$codigoNovo=$_REQUEST['codigo'];

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
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	$query = $bd->query("UPDATE aluno SET ".
	"codAluno='".$_REQUEST['codigo']."', ".
	"nome='".$_REQUEST['nome']."', ".
	"email='".$_REQUEST['email']."' ".
	"WHERE codAluno='".$_REQUEST['oldid']."'"
	);
	$aluno = $query->fetch();

echo "<p>Informação alterada. <a href='listarAluno.php'>Voltar ao inicio</a></p>";
}
else{
    echo "<p>O aluno com o código ".$codigoNovo." já existe, por favor adicione de novo</p>";
    echo "<address><a href='listarAluno.php'>Voltar ao formulário</a></address>";
}

//UPDATE table_name
?>