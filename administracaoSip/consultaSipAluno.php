<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codAluno=$_REQUEST['aluno'];
$codsProj=getCodProjFromCodAluno($codAluno);
//$codsEnunciado=getCodEnunciadoFromCodProj($codsProj);

echo "<script src='verificaForm.js'></script>";
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
echo "<h1>Consulta de SIPs</h1>
        <form id='myform' action='getSip.php' method='get' onsubmit='return verificarCamposVazios();'>
            <fieldset>
                Selecione a submissao
                <select id='submissao' name='submissao'>";
                foreach($codsProj as $codProj){
                    $query = $bd->query("SELECT titulo FROM projeto_submissao WHERE codProj='".$codProj."'");
                        while ($linha = $query->fetch()){
                        echo "<option value='".$codProj."'>".$linha['titulo']."</option>";
                    }
                }
                echo "
                </select>
                <br/>
                </select>
                <br/><br/>
                </fieldset>
            <br/>
            <input type='submit' value='Enviar' id='enviar'/>
        </form>
        <br/>";


function getCodProjFromCodAluno($codAluno){
    $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
logMessage("codAluno". $codAluno);
     $query = $bd->query("SELECT codProj FROM projeto_aluno WHERE codAluno='".$codAluno."'");
     $codsProj=array();
     while ($linha = $query->fetch()){
        array_push($codsProj, $linha['codProj']);
        logMessage("linha". $linha['codProj']);
        }
    logMessage("codsProj size".count($codsProj));
    return $codsProj;
}

function getCodEnunciadoFromCodProj($codsProj){
    $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $codsEnunciado=array();
    for ($i=0; $i < count($codsProj); $i++){
    $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codsProj[$i]."'");
    while ($linha = $query->fetch()){
        array_push($codsEnunciado, $linha['codEnunciado']);
         logMessage("linha". $linha['codEnunciado']);
        }
    }

    logMessage("codsEnunciado size".count($codsEnunciado));
    return $codsEnunciado;
}



function echoGoBack(){
echo "<address><a href='pagPrincipal.html'>Voltar atrás</a></address>";
}
function logMessage($message)
{
    echo "<script>console.log('LOG: ".$message."');</script>";
}

?>
