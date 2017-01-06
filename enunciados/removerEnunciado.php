<?php

	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

	$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$_REQUEST['enunciado']."'");

	$enunciado = $query->fetch();
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	echo "<table>";
	echo "<tr><td>Código Enunciado:</td><td>".$enunciado['codEnunciado']."</td></tr>";
	echo "<tr><td>Código Disciplina:</td><td>".$enunciado['codUC']."</td></tr>";
	echo "<tr><td>Data início:</td><td>".$enunciado['dataInicio']."</td></tr>";
	echo "<tr><td>Data fim:</td><td>".$enunciado['dataFim']."</td></tr>";
  	echo "<tr><td>Descrição:</td><td>".$enunciado['descricao']."</td></tr>";
    echo "</table>";

	echo "<form action='removerEnunciado2.php' method='get'>";
	echo "<p>Confirma a remoção deste registo?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
    echo "</select>";
    echo "<input type='hidden' name='codEnunciado' value='".$enunciado['codEnunciado']."'/>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";

?>
