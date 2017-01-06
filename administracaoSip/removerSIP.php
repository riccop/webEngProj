<?php
$codProj = $_REQUEST['submissao'];
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
echo "<h3>Workteam</h3>";
echo getWorkteam($codProj);
echo "<h3>Informações submissão</h3>";
echo getInformacaoSIP($codProj);
echo "<h3>Ficheiros</h3>";
echo "<ul>";
foreach (getFiles($codProj) as $filename) {
  echo "<li>".$filename."</li>";
}
echo "</ul>";

echo "<form action='removerSIP2.php' method='get'>";
echo "<p>Confirma a remoção deste registo?</p>";
echo "<select name='resposta'>";
echo "<option value='1'>Sim</option>";
echo "<option value='0'>Não</option>";
  echo "</select>";
  echo "<input type='hidden' name='submissao' value='".$codProj."'/>";
  echo "<input type='submit' value='Enviar'/>";
  echo "</form>";

function getInformacaoSIP($codProj){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("SELECT titulo,subtitulo,datainicio,datafim,resumo FROM projeto_submissao WHERE codProj='".$codProj."'");
  $infos = $query->fetch();
  return "<p><b>Título: </b>".$infos['titulo']."</p>".
  "<p><b>Subtítulo: </b>".$infos['subtitulo']."</p>".
  "<p><b>Data início: </b>".$infos['datainicio']."</p>".
  "<p><b>Data fim: </b>".$infos['datafim']."</p>".
  "<p><b>Resumo: </b>".$infos['resumo']."</p>";
}

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
  $workteamStr='<table>';
  foreach (getCodsAluno($codProj) as $codAluno) {
  $query = $bd->query("SELECT nome, email FROM aluno WHERE codAluno='".$codAluno."'");
  $nome = $query->fetch();
  $workteamStr.="<tr><td>Código aluno:</td><td>".$codAluno."</td></tr>";
  $workteamStr.="<tr><td>Nome:</td><td>".$nome["nome"]."</td></tr>";
  $workteamStr.="<tr><td>Email:</td><td>".$nome["email"]."</td></tr>";
  $workteamStr.="<tr><td><br/></td><td><br/></td></tr>";
  }
  return $workteamStr.'</table>';

  echo "<table>";
  echo "<tr><td>Codigo:</td><td>".$aluno['codAluno']."</td></tr>";
  echo "<tr><td>Nome:</td><td>".$aluno['nome']."</td></tr>";
  echo "<tr><td>Email:</td><td>".$aluno['email']."</td></tr>";
    echo "</table>";
}

function getFiles($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $ficheiros=array();

      $query = $bd->query("SELECT diretoria FROM ficheiro WHERE codProj='".$codProj."'");

      while ($linha = $query->fetch()){
       array_push($ficheiros, basename($linha['diretoria']));
      }
    return $ficheiros;
}

?>
