<?php
 	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	echo "<form action='removerTodosOsAlunos2.php' method='get'>";
	echo "<p>Confirma a remoção total da informação?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
	
    echo "</select>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";
    
    echo "<address><a href='pagPrincipalAlunos.html'/>Voltar ao início</address>";
    echo "<hr width='80%' align='center'/>";
    echo "<address align='center'>EngWeb2015 - projeto final</address>";
	
?>
