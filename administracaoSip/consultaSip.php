<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codEnunciado=$_REQUEST['enunciado'];
$query = $bd->query("SELECT * FROM projeto_submissao WHERE codEnunciado='".$codEnunciado."'");
$codsProj=array();

while ($linha = $query->fetch()){
        array_push($codsProj,$linha['codProj']);
        }
$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
$descricao="";

while ($linha = $query->fetch()){
        $descricao=$linha['descricao'];
        }

echo "<script src='verificaForm.js'></script>";
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
echo "<h1>Selecionar o SIP - ".(string)$descricao."</h1>

        <form id='myform' action='getSIP.php' method='get' onsubmit='return verificarCamposVazios();'>

            <fieldset>
                Selecione a submissão
                <select id='submissao' name='submissao'>";
                foreach($codsProj as $codProj){
                $string = getWorkTeam($codProj);
                echo "<option value='".$codProj."'>".$string."</option>";
                }
                echo "</select>
                <br/><br/>
                <input type='hidden' value='".$codEnunciado."' name='enunciado' id='enunciado'/>
                </fieldset>
            <br/>
            <input type='submit' value='Enviar' id='enviar'/>
        </form>
        <br/>";

function getWorkTeam($codProj)
{
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT codAluno FROM projeto_aluno WHERE codProj='".$codProj."'");
     $codsAlunos=array();
     while ($linha = $query->fetch()){
        array_push($codsAlunos, $linha['codAluno']);
        }
        $string="";
    foreach($codsAlunos as $codAluno){
    $query = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$codAluno."'");
    while ($linha = $query->fetch()){
        $string .= $linha['nome'].'+';
        }
    }
    $string=substr($string,0,-1);
    return $string;
}
?>
