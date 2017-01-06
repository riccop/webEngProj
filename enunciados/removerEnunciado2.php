<?php
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM enunciado WHERE codEnunciado='".$_REQUEST['codEnunciado']."'");
	   echo "<p>Enunciado ".$_REQUEST['codEnunciado']." removido. </p><p><a href='pagPrincipalEnunciados.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada.</p><p><a href='pagPrincipalEnunciados.html'>Voltar ao início</a></p>";
    }

?>
