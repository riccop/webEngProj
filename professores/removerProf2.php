<?php
  echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM professor WHERE codProf='".$_REQUEST['idProf']."'");
	   echo "<p>Professor ".$_REQUEST['idProf']." removido. </p><p><a href='pagPrincipalProfs.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada.</p><p><a href='pagPrincipalProfs.html'>Voltar ao início</a></p>";
    }

?>
