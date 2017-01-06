<?php
 
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$disciplinas = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	
	foreach($disciplinas->disciplina as $d) 
	  { 
	  $qstring = $bd->prepare("INSERT INTO disciplina VALUES ('".$p['id']."', '".(string)$p->designacao."', '".(string)$p->curso."', '".(string)$p->ano."', '".(string)$p->codProf."')");
	  $bd->query($qstring);
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalDiscs.html'>
 Voltar ao inicio</a></p>";
	
?>	
