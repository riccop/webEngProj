<?php
 
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	$query = $bd->query("UPDATE professor SET ".
	"codProf='".$_REQUEST['codigoProf']."', ".
	"nome='".$_REQUEST['nome']."', ".
	"departamento='".$_REQUEST['departamento']."', ".
	"email='".$_REQUEST['email']."' ".
	"WHERE codProf='".$_REQUEST['oldid']."'"
	);
	$professor = $query->fetch();

echo "<p>Informação alterada. <a href='listarProf.php'>Voltar ao inicio</a></p>";

//UPDATE table_name
?>