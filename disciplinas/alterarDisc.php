<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
 
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	
	$query = $bd->query("SELECT * FROM disciplina WHERE codUC='".$_REQUEST['idDisc']."'");
	$disciplina = $query->fetch();
	//recebe o ID do disc, faz um select para obter os dados desse disc
	//apresenta um formulário com os valores para que sejam alterados e submetidos
	//depois é chamada a script alterarDisc2.php para fazer o UPDATE
	$oldid=$disciplina['codUC'];
	echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>";
    echo "<script src='verificaForm.js'></script>";
	
	echo "<form action='alterarDisc2.php' method='get' onsubmit='return verificarCamposVazios();'>";
	echo "<table>";

	echo "<tr><td>Codigo:</td><td><input type='text' name='codigo' size='10'".
	"value='".$disciplina['codUC']."'/></td></tr>";
	
	echo "<tr><td>Designação:</td><td><input type='text' name='designacao' size='60'".
	"value='".$disciplina['designacao']."'/></td></tr>";
	
	echo "<tr><td>Curso:</td><td><input type='text' name='curso' size='50'".
	"value='".$disciplina['curso']."'/></td></tr>";
	
	echo "<tr><td>Email:</td><td><input type='text' name='ano' size='30'".
	"value='".$disciplina['ano']."'/></td></tr>";
	
	echo "</table>";
	echo "<input type='hidden' name='oldid' value='".$oldid."' />";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
    
    echo "<address><a href='pagPrincipalDiscs.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
	
?>
