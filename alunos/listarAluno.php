<?php
 
	echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  echo "<h1 align='center'>Gestão de Alunos</h1>";
  echo "<ul>";
  echo "<li><a href='loadXML.html'>Carregar do XML</a></li>";
  echo "<li><a href='reset.php'>Apagar a tabela</a></li>";
  echo "</ul>";
  echo "<table  style='text-align:center;'>".
  "<tr><th>Código</th><th>Nome</th><th>Email</th><th>Ops</th></tr>";
       
        $query = $bd->query("SELECT * FROM aluno");
       
        while ($linha = $query->fetch()){
                echo "<tr><td>".$linha['codAluno']."</td>";
                echo "<td>".$linha['nome']."</td>";
                echo "<td>".$linha['email']."</td>";
                echo "<td><a href='alterarAluno.php?idAluno=".
                     $linha['codAluno']."'>Alterar</a>".
                     " <a href='removerAluno.php?idAluno=".
                     $linha['codAluno']."'>Remover</a>";
                echo "</tr>";
        }
        echo "</table><br/>  <a href='pagPrincipalAlunos.html'>Voltar ao ínicio</a>";
?>
