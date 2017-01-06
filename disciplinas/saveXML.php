<?php
//save database to XML
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	//$disciplinas = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
	$qstring = $bd->query("SELECT * FROM disciplina");
	
	$discs = new DOMDocument('1.0', "UTF-8");
	$root = $discs->createElement("disciplinas");
	
	while($p = $qstring->fetch())
	  { 
	  $disc= $discs->createElement("disciplina");
	    $codigoAtributo = $discs->createAttribute('id');
	    $codigoAtributo->value="".$p['codUC']."";
	    $disc->appendChild($codigoAtributo);
	    //$disc=
        $designacao= $discs->createElement("designacao");
        $curso= $discs->createElement("curso");
        $ano= $discs->createElement("ano");
        $codProf= $discs->createElement("codProf");
	   // $disc = $discs->xpath("//disciplina[codigo='".$codigoAnterior."']");
        //print_r($p);
        //echo "COD= ".$p['codigoProf'];
        //$codigo->appendChild($discs->createTextNode($p['codigoProf']));
        
        $designacao->appendChild($discs->createTextNode($p['designacao']));
        $curso->appendChild($discs->createTextNode($p['curso']));
        $ano->appendChild($discs->createTextNode($p['ano']));
        $codProf->appendChild($discs->createTextNode($p['codProf']));
//$disc->appendChild($codigo);
$disc->appendChild($designacao);
$disc->appendChild($curso);
$disc->appendChild($ano);
$disc->appendChild($codProf);
$root->appendChild($disc);
//$disc= $discs->createElement("disciplina");
	}
$discs->appendChild($root);
//$root->appendChild($disc);

//esta linha abaixo permite reescrever o ficheiro com as alterações
 $discs->save("temp/disciplinas.xml");
echo "<p>Ficheiro XML guardado com sucesso.</p><p><a href='pagPrincipalDiscs.html'>Voltar ao início</a></p>";

?>