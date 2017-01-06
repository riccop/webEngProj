<?php
//save database to XML
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	//$disciplinas = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	$qstring = $bd->query("SELECT * FROM aluno");
	
	$alunos = new DOMDocument('1.0', "UTF-8");
	$root = $alunos->createElement("alunos");
	
	while($p = $qstring->fetch())
	  { 
	  $aluno= $alunos->createElement("aluno");
	    $codigoAtributo = $alunos->createAttribute('id');
	    $codigoAtributo->value="".$p['codAluno']."";
	    $aluno->appendChild($codigoAtributo);
	    //$disc=
        $nome= $alunos->createElement("nome");
        $email= $alunos->createElement("email");

	   // $disc = $discs->xpath("//disciplina[codigo='".$codigoAnterior."']");
        //print_r($p);
        //echo "COD= ".$p['codigoProf'];
        //$codigo->appendChild($discs->createTextNode($p['codigoProf']));
        
        $nome->appendChild($alunos->createTextNode($p['nome']));
        $email->appendChild($alunos->createTextNode($p['email']));
        
//$disc->appendChild($codigo);
$aluno->appendChild($nome);
$aluno->appendChild($email);

$root->appendChild($aluno);
//$disc= $discs->createElement("disciplina");
	}
$alunos->appendChild($root);
//$root->appendChild($disc);

//esta linha abaixo permite reescrever o ficheiro com as alterações
 $alunos->save("temp/alunos.xml");
echo "<p>Ficheiro XML guardado com sucesso.</p><p><a href='pagPrincipalAlunos.html'>Voltar ao início</a></p>";

?>