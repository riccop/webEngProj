<?php
 
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$professores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	$query = $bd->prepare("INSERT INTO professor VALUES (:codProf, :nome, :departamento, :email)");
	foreach($professores->professor as $p) 
	  { 
	    $query->bindValue(":codProf", $p['id'], PDO::PARAM_STR);
		$query->bindValue(":nome", (string)$p->nome, PDO::PARAM_STR);
		$query->bindValue(":departamento", (string)$p->departamento, PDO::PARAM_STR);
		$query->bindValue(":email", (string)$p->email, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalProfs.html'>
 Voltar ao inicio</a></p>";
	
?>	
