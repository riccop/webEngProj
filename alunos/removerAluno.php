<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$query = $bd->query("SELECT * FROM aluno WHERE codAluno='".$_REQUEST['idAluno']."'");
	
	$aluno = $query->fetch();
	
	echo "<table>";
	echo "<tr><td>Codigo:</td><td>".$aluno['codAluno']."</td></tr>";
	echo "<tr><td>Nome:</td><td>".$aluno['nome']."</td></tr>";
	echo "<tr><td>Email:</td><td>".$aluno['email']."</td></tr>";
    echo "</table>";
    
	echo "<form action='removerAluno2.php' method='get'>";
	echo "<p>Confirma a remoção deste registo?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
    echo "</select>";
    echo "<input type='hidden' name='idAluno' value='".$aluno['codAluno']."'/>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
    echo "<address><a href='pagPrincipalAlunos.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
	
?>
