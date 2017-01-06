<?php
 
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$alunos = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	
	
	foreach($alunos->aluno as $d) 
	  { 
	  $qstring = $bd->prepare("INSERT INTO aluno VALUES ('".$p['codAluno']."', '".(string)$p->nome."', '".(string)$p->email."')");
	  $bd->query($qstring);
	}
	echo "<p>Logs importados com sucesso. <a href='pagPrincipalAlunos.html'>
 Voltar ao inicio</a></p>";
	
?>	
