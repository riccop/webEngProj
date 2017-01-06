<?php
$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['prof'];
}
if($form=="f2"){
$codigo=$_REQUEST['profLista'];
}
//ir ao ficheiro XML, encontrar o professor e alterar os dados lá no XML
$profs = simplexml_load_file("professores.xml");

$prof = $profs->xpath("//professor[codigo='".$codigo."']");
$nome=(string)$prof[0]->nome;

    $dom=dom_import_simplexml($prof[0]);
    $dom->parentNode->removeChild($dom);
    
//echo $profs->asXml();

 //esta linha abaixo permite reescrever o ficheiro com as alterações
 $profs->asXML("professores.xml");
 
 //echo asXML();  //imprime o ficheiro xml no browser
 echo "<p>".$nome." removido com sucesso.</p>";
 echo "<address><a href='index.html'>Voltar ao início</a></address>"

?>