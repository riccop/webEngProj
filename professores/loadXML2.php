<?php
 
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$professores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	
	foreach($professores->professor as $p) 
	  { 
	  $qstring = $bd->prepare("INSERT INTO professor VALUES ('".$p['id']."', '".(string)$p->nome."', '".(string)$p->departamento."', '".(string)$p->email."')");
	  $bd->query($qstring);
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalProfs.html'>
 Voltar ao inicio</a></p>";
	
?>	
