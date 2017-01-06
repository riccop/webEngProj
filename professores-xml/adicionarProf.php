<?php
//devia-se fazer as verificações para ver se o prof ja foi adicionado

$profs = simplexml_load_file("professores.xml");
 $p = $profs->addChild('professor'); //adiciona um filho abaixo de professores, que é um professor
 //o $p é um professor
 $p->addChild('codigo',$_REQUEST['codigo']);
 $p->addChild('nome',$_REQUEST['nome']);
 $p->addChild('departamento',$_REQUEST['departamento']);
 
 //esta linha abaixo permite reescrever o ficheiro com as alterações
 $profs->asXML("professores.xml");
 
 //echo asXML();  //imprime o ficheiro xml no browser
 echo "<p>".$_REQUEST['nome']." adicionado com sucesso.</p>";
 echo "<address><a href='index.html'>Voltar ao início</a></address>"



?>