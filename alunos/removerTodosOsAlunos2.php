<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM aluno");
	   echo "<p>Informação removida. <a href='listarAluno.php'>Voltar ao inicio</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada. <a href='listarAluno.php'>Voltar ao inicio</a></p>";
    }

?>
