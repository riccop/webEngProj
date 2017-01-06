<?php
 
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	$query = $bd->query("SELECT * FROM professor WHERE codProf='".$_REQUEST['idProf']."'");
	$professor = $query->fetch();
	//recebe o ID do prof, faz um select para obter os dados desse prof
	//apresenta um formulário com os valores para que sejam alterados e submetidos
	//depois é chamada a script alterarProf2.php para fazer o UPDATE
	$oldid=$professor['codProf'];
	
	echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>";
    echo "<script src='verificaForm.js'></script>";
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	echo "<form action='alterarProf2.php' method='get' onsubmit='return verificarCamposVazios();'>";
	echo "<table>";

	echo "<tr><td>Codigo:</td><td><input type='text' name='codigoProf' size='10'".
	"value='".$professor['codProf']."'/></td></tr>";
	
	echo "<tr><td>Nome:</td><td><input type='text' name='nome' size='60'".
	"value='".$professor['nome']."'/></td></tr>";
	
	echo "<tr><td>Departamento:</td><td><input type='text' name='departamento' size='50'".
	"value='".$professor['departamento']."'/></td></tr>";
	
	echo "<tr><td>Email:</td><td><input type='text' name='email' size='30'".
	"value='".$professor['email']."'/></td></tr>";
	echo "</table>";
	echo "<input type='hidden' name='oldid' value='".$oldid."' />";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
    echo "<address><a href='pagPrincipalProfs.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
	
?>
