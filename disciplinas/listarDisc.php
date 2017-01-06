<?php
 
	
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
  echo "<h1 align='center'>Gestão de Disciplinas</h1>";
  echo "<ul>";
  echo "<li><a href='loadXML.html'>Carregar do XML</a></li>";
  echo "<li><a href='reset.php'>Apagar a tabela</a></li>";
  echo "</ul>";
  echo "<table  style='text-align:center;'>".
  "<tr><th>Código</th><th>Designação</th>".
  "<th>Curso</th><th>Ano</th><th>Codigo Prof</th><th>Ops</th></tr>";
       
        $query = $bd->query("SELECT * FROM disciplina");
       
        while ($linha = $query->fetch()){
                echo "<tr><td>".$linha['codUC']."</td>";
                echo "<td>".$linha['designacao']."</td>";
                echo "<td>".$linha['curso']."</td>";
                echo "<td>".$linha['ano']."</td>";
                echo "<td>".$linha['codProf']."</td>";
                echo "<td><a href='alterarDisc.php?idDisc=".
                     $linha['codUC']."'>Alterar</a>".
                     " <a href='removerDisc.php?idDisc=".
                     $linha['codUC']."'>Remover</a>";
                echo "</tr>";
        }
        echo "</table><br/>  <a href='pagPrincipalDiscs.html'>Voltar ao ínicio</a>";
?>
