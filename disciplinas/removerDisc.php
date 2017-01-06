<?php
 
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$query = $bd->query("SELECT * FROM disciplina WHERE codUC='".$_REQUEST['idDisc']."'");
	
	$disciplina = $query->fetch();
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	echo "<table>";
	echo "<tr><td>Codigo:</td><td>".$disciplina['codUC']."</td></tr>";
	echo "<tr><td>Designação:</td><td>".$disciplina['designacao']."</td></tr>";
	echo "<tr><td>Curso:</td><td>".$disciplina['curso']."</td></tr>";
	echo "<tr><td>Ano:</td><td>".$disciplina['ano']."</td></tr>";
	echo "<tr><td>Codigo Professor:</td><td>".$disciplina['codProf']."</td></tr>";
    echo "</table>";
    
	echo "<form action='removerDisc2.php' method='get'>";
	echo "<p>Confirma a remoção deste registo?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
    echo "</select>";
    echo "<input type='hidden' name='idDisc' value='".$disciplina['codUC']."'/>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
    echo "<address><a href='pagPrincipalDiscs.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
	
?>
