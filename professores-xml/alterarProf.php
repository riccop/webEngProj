<?php
//ir ao ficheiro XML, encontrar o professor e alterar os dados lá no XML
$codigoAnterior=$_REQUEST['codigoAnterior'];
$codigoNovo=$_REQUEST['codigo'];
$departamento=$_REQUEST['departamento'];
$nome=$_REQUEST['nome'];

$profs = simplexml_load_file("professores.xml");

$prof = $profs->xpath("//professor[codigo='".$codigoAnterior."']");
$prof[0]->nome=$nome;
$prof[0]->codigo=$codigoNovo;
$prof[0]->departamento=$departamento;

 //esta linha abaixo permite reescrever o ficheiro com as alterações
 $profs->asXML("professores.xml");
 
 //echo asXML();  //imprime o ficheiro xml no browser
 echo "<p>".$_REQUEST['nome']." alterado com sucesso.</p>";
 echo "<address><a href='index.html'>Voltar ao início</a></address>"

?>