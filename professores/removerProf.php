<?php
  echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$query = $bd->query("SELECT * FROM professor WHERE codProf='".$_REQUEST['idProf']."'");
	
	$professor = $query->fetch();
	
	echo "<table>";
	echo "<tr><td>Codigo:</td><td>".$professor['codProf']."</td></tr>";
	echo "<tr><td>Nome:</td><td>".$professor['nome']."</td></tr>";
	echo "<tr><td>Dep.:</td><td>".$professor['departamento']."</td></tr>";
	echo "<tr><td>Email:</td><td>".$professor['email']."</td></tr>";
    echo "</table>";
    
	echo "<form action='removerProf2.php' method='get'>";
	echo "<p>Confirma a remoção deste registo?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
    echo "</select>";
    echo "<input type='hidden' name='idProf' value='".$professor['codProf']."'/>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
	    echo "<address><a href='pagPrincipalDiscs.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
?>
