<?php
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
     $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM enunciado");
	   echo "<p>Informação removida. <a href='pagPrincipalEnunciados.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada. <a href='pagPrincipalEnunciados.html'>Voltar ao início</a></p>";
    }

?>
