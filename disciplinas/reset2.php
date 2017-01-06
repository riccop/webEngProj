<?php
 
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM disciplina");
	   echo "<p>Informação removida. <a href='listarDisc.php'>Voltar ao inicio</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada. <a href='listarDisc.php'>Voltar ao inicio</a></p>";
    }

?>
