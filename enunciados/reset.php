<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	echo "<form action='reset2.php' method='get'>";
	echo "<p>Confirma a remoção total da informação?</p>";
	echo "<select name='resposta'>";
	echo "<option value='1'>Sim</option>";
	echo "<option value='0'>Não</option>";
    echo "</select>";
    echo "<input type='submit' value='Enviar'/>";
    echo "</form>";

?>
