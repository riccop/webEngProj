<?php
 
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$alunos = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	$query = $bd->prepare("INSERT INTO aluno VALUES (:codAluno, :nome, :email)");
	foreach($alunos->aluno as $d) 
	  { 
	    $query->bindValue(":codAluno", $d['id'], PDO::PARAM_STR);
		$query->bindValue(":nome", (string)$d->nome, PDO::PARAM_STR);
		$query->bindValue(":email", (string)$d->email, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalAlunos.html'>
 Voltar ao inicio</a></p>";
	
?>	
