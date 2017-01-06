<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM disciplina WHERE codUC='".$_REQUEST['idDisc']."'");
	   echo "<p>Disciplina ".$_REQUEST['idDisc']." removida. </p><p><a href='pagPrincipalDiscs.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada.</p><p><a href='pagPrincipalDiscs.html'>Voltar ao início</a></p>";
    }

?>
