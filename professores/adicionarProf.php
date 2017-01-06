<?php

echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';

	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $professorExists=false;
	//$professores = simplexml_load_file($_FILES['ficheiro']['tmp_name']);
    echo "<h1>Adicionar Professor</h1>";
//Primeiro é necessário verificar se já existe um professor com o código que vai ser inserido
      $query = $bd->query("SELECT codProf FROM professor WHERE codProf='".$_REQUEST['codigo']."'");
     while ($linha = $query->fetch()){
                //echo "Cod professor BD ".$linha['codigoProf']."";
                if($linha['codProf']==$_REQUEST['codigo']){
                    $professorExists=true;
                    //echo "Encontrei professor!";
                }
        }

if($professorExists==false){
	$query = $bd->prepare("INSERT INTO professor VALUES (:codProf, :nome, :departamento, :email)");
	    $query->bindValue(":codProf", $_REQUEST['codigo'], PDO::PARAM_STR);
		$query->bindValue(":nome", (string)$_REQUEST['nome'], PDO::PARAM_STR);
		$query->bindValue(":departamento", (string)$_REQUEST['departamento'], PDO::PARAM_STR);
		$query->bindValue(":email", (string)$_REQUEST['email'], PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
		 echo "<p>".$_REQUEST['nome']." adicionado com sucesso.</p>";
		 echo "<table  style='text-align:center;'>".
  "<tr><th>Código</th><th>Nome</th>".
  "<th>Departamento</th><th>Email</th></tr>"; 
		 echo "<tr><td>".$_REQUEST['codigo']."</td>";
                echo "<td>".$_REQUEST['nome']."</td>";
                echo "<td>".$_REQUEST['departamento']."</td>";
                echo "<td>".$_REQUEST['email']."</td>";
                echo "</tr>";
         echo "</table><br/>";
    }
else{
    echo "<p>O professor com o código ".$_REQUEST['codigo']." já existe, por favor adicione de novo</p>";
    echo "<address><a href='adicionarProf.html'>Voltar ao formulário</a></address>";
}
 echo "<address><a href='pagPrincipalProfs.html'>Voltar ao início</a></address>";

?>