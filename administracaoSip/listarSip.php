<?php

echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
  echo "<h1 align='center'>Administração de SIPs</h1>";
  echo "<ul>";
  echo "<li><a href='reset.php'>Apagar a tabela e todos os dados associados.</a></li>";
  echo "</ul>";
  echo "<table style='text-align:center;'>".
  "<tr><th>Enunciado</th><th>Título</th><th>Workteam (código - nome)</th><th>Ops</th></tr>";

        $codsProj = getCodsProj();

        foreach ($codsProj as $codProj )
        {
          echo "<tr><td>".getDescrEnunciado($codProj,getCodEnunciado($codProj))."</td>";
                echo "<td>".getTitulo($codProj)."</td>";
                echo "<td>".getWorkteam($codProj)."</td>";
                echo "<td><a href='getSIP.php?submissao=".$codProj."&enunciado=".getCodEnunciado($codProj)."'>Alterar</a>".
                     " <a href='removerSIP.php?submissao=".$codProj."'>Remover</a>";
                echo "</tr>";
        }
        echo "</table><br/>  <a href='pagPrincipalSips.html'>Voltar ao ínicio</a>";

function getCodsAluno($codProj)
{
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT codAluno FROM projeto_aluno WHERE codProj='".$codProj."'");
  $codsAluno = array();
  while ($linha = $query->fetch()){
    array_push($codsAluno,$linha['codAluno']);
  }
  return $codsAluno;
}

function getWorkteam($codProj){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $workteamStr='';
  foreach (getCodsAluno($codProj) as $codAluno) {
  $query = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$codAluno."'");
  $nome = $query->fetch();
  $workteamStr.="<p>".$codAluno."-".$nome['nome']."</p>";
  }
  return $workteamStr;
}

function getTitulo($codProj){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT titulo,subtitulo FROM projeto_submissao WHERE codProj='".$codProj."'");
  $titulo = $query->fetch();
  return "<p>".$titulo['titulo']."</p><p>".$titulo['subtitulo']."</p>";
}

function getDescrEnunciado($codProj,$codEnunciado){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT enunciado.descricao FROM enunciado,projeto_submissao WHERE projeto_submissao.codProj='".$codProj."' AND enunciado.codEnunciado='".$codEnunciado."'");
  $descricao = $query->fetch();
  return $descricao['descricao'];
}

function getCodEnunciado($codProj){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codProj."'");
  $codEnunciado = $query->fetch();
  return $codEnunciado['codEnunciado'];
}

function getCodsProj(){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT codProj FROM projeto_submissao");
  $codsProj = array();
  while ($linha = $query->fetch()){
    array_push($codsProj,$linha['codProj']);
  }
  return $codsProj;
}

?>
