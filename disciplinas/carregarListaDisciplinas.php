<?php
 
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$disciplinas = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	$query = $bd->prepare("INSERT INTO disciplinas VALUES (:codUC, :designacao, :curso, :ano ,:codProf)");
	foreach($disciplinas->disciplina as $d) 
	  { 
	    $query->bindValue(":codUC", $d['id'], PDO::PARAM_STR);
		$query->bindValue(":designacao", (string)$d->designacao, PDO::PARAM_STR);
		$query->bindValue(":curso", (string)$d->curso, PDO::PARAM_STR);
		$query->bindValue(":ano", (string)$d->ano, PDO::PARAM_STR);
		$query->bindValue(":codProf", (string)$d->codProf, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalDiscs.html'>
 Voltar ao inicio</a></p>";
	
?>	
