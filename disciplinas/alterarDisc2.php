<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
 	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codigoAnterior=$_REQUEST['oldid'];
$codigoNovo=$_REQUEST['codigo'];

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
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	$query = $bd->query("UPDATE disciplina SET ".
	"codUC='".$_REQUEST['codigo']."', ".
	"designacao='".$_REQUEST['designacao']."', ".
	"curso='".$_REQUEST['curso']."', ".
	"ano='".$_REQUEST['ano']."' ".
	"WHERE codUC='".$_REQUEST['oldid']."'"
	);
	$disciplina = $query->fetch();

echo "<p>Informação alterada. <a href='listarDisc.php'>Voltar ao inicio</a></p>";
}
else{
    echo "<p>A disciplina com o código ".$codigoNovo." já existe, por favor adicione de novo</p>";
    echo "<address><a href='listarDisc.php'>Voltar ao formulário</a></address>";
}

//UPDATE table_name
?>