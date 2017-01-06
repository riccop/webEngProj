<?php
	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $alunoExists=false;
    $profExiste=false;
    echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    echo "<h1>Adicionar Aluno</h1>";
//Primeiro é necessário verificar se já existe um Disciplina com o código que vai ser inserido
      $query = $bd->query("SELECT codAluno FROM aluno WHERE codAluno='".$_REQUEST['codigo']."'");
     while ($linha = $query->fetch()){
                //echo "Cod Disciplina BD ".$linha['codUC']."";
                if($linha['codAluno']==$_REQUEST['codigo']){
                    $alunoExists=true;
                    //echo "Encontrei Disciplina!";
                }
        }
    if($alunoExists==false){
	   $query = $bd->prepare("INSERT INTO aluno VALUES (:codAluno, :nome, :email)");
	       $query->bindValue(":codAluno", $_REQUEST['codigo'], PDO::PARAM_STR);
		   $query->bindValue(":nome", (string)$_REQUEST['nome'], PDO::PARAM_STR);
		   $query->bindValue(":email", (string)$_REQUEST['email'], PDO::PARAM_STR);
		   $query->execute();
		   $query->closeCursor();
	       echo "<p>".$_REQUEST['nome']." adicionado com sucesso.</p>";
		   echo "<table border='1' style='text-align:center;'>".
           "<tr><th>Código</th><th>Nome</th><th>Email</th></tr>";
		   echo "<tr><td>".$_REQUEST['codigo']."</td>";
           echo "<td>".$_REQUEST['nome']."</td>";
           echo "<td>".$_REQUEST['email']."</td>";
           echo "</tr>";
           echo "</table><br/>";
        }
    else{
        echo "<p>O aluno com o código ".$_REQUEST['codigo']." já existe, por favor adicione de novo</p>";
        echo "<address><a href='adicionarAluno.html'>Voltar ao formulário</a></address>";
    }

 echo "<address><a href='pagPrincipalAlunos.html'>Voltar ao início</a></address>";

?>