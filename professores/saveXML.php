<?php
//save database to XML
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	//$professores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	$qstring = $bd->query("SELECT * FROM professor");
	
	$profs = new DOMDocument('1.0', "UTF-8");
	$root = $profs->createElement("professores");
	
	while($p = $qstring->fetch())
	  { 
	  $prof= $profs->createElement("professor");
	    $codigoAtributo = $profs->createAttribute('id');
	    $codigoAtributo->value="".$p['codProf']."";
	    $prof->appendChild($codigoAtributo);
	    //$prof=
        $nome= $profs->createElement("nome");
        $departamento= $profs->createElement("departamento");
        $email= $profs->createElement("email");
	   // $prof = $profs->xpath("//professor[codigo='".$codigoAnterior."']");
        //print_r($p);
        //echo "COD= ".$p['codigoProf'];
        //$codigo->appendChild($profs->createTextNode($p['codigoProf']));
        
        $nome->appendChild($profs->createTextNode($p['nome']));
        $departamento->appendChild($profs->createTextNode($p['departamento']));
        $email->appendChild($profs->createTextNode($p['email']));
//$prof->appendChild($codigo);
$prof->appendChild($nome);
$prof->appendChild($departamento);

$prof->appendChild($email);
$root->appendChild($prof);
//$prof= $profs->createElement("professor");
	}
$profs->appendChild($root);
//$root->appendChild($prof);

//esta linha abaixo permite reescrever o ficheiro com as alterações
 $profs->save("temp/professores.xml");
echo "<p>Ficheiro XML guardado com sucesso.</p><p><a href='pagPrincipalProfs.html'>Voltar ao início</a></p>";

?>