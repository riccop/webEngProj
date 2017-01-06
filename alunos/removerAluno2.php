<?php
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
	   $query = $bd->query("DELETE FROM aluno WHERE codAluno='".$_REQUEST['idAluno']."'");
	   echo "<p>Aluno ".$_REQUEST['idAluno']." removido. </p><p><a href='pagPrincipalAlunos.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada.</p><p><a href='pagPrincipalAlunos.html'>Voltar ao início</a></p>";
    }

?>
