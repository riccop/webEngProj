<?php

header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8');

$codProj=$_REQUEST['submissao'];

$keyname = getKeyName($codProj);
$title = getTitle($codProj);
$subtitle = getSubtitle($codProj);
$begindate = getBeginDate($codProj);
$enddate = getEndDate($codProj);
$prof=getSupervisorData($codProj);
$supervisorName=$prof[0];
$supervisorEmail=$prof[1];
$supervisorDepartment=$prof[2];
$abstract = getAbstract($codProj);
//$codEnunciado = getEnunciado($codProj);
$memberNames= getWorkTeamNames($codProj);
$memberEmails=getWorkTeamEmails($codProj);
$memberIdentifiers=getWorkTeamIdentifiers($codProj);
$ficheiros=getDeliverables($codProj);


    $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codEnunciado=getCodEnunciado($codProj);
$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
$descricao="";

while ($linha = $query->fetch()){
        $descricao=$linha['descricao'];
        }
echo "<html>
    <head>
        <title>Project Record</title>
        <meta charset='UTF-8'/>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
        <script src='projectrecord-dynamic.js'></script>
        <script src='verificaFormSubmissaoSIP.js'></script>
        <link rel='stylesheet' type='text/css' href='mystyles.css'>
    </head>
    <body>
        <h2>Project Record Form - ".$descricao."</h2>
        <form action='projectrecord-dynamic-update.php' method='post' enctype='multipart/form-data' onsubmit='return verificarCamposVazios();'>
        <input type='hidden' name='enunciado' id='enunciado' value='".$codEnunciado."'/>
        <input type='hidden' name='projeto' id='projeto' value='".$codProj."'/>
        <fieldset>
            <legend>Meta data</legend>
         <table>
             <tr>
                 <td><label for='keyname'>Keyname:</label></td>
                 <td><input type='text' size='50' name='keyname' id='keyname' value='".$keyname."'/></td>
            </tr>
        <tr>
            <td><label for='title'>Title:</label></td>
            <td><input type='text' size='50' name='title' id='title' value='".$title."'/></td>
        </tr>
             <tr>
                 <td><label for='subtitle'>Subtitle:</label></td>
                 <td><input type='text' size='50' name='subtitle' id='subtitle' value='".$subtitle."'/></td>

             </tr>
             <tr>
                 <td><label for='begindate'>Begin Date:</label></td>
                 <td><input type='text' size='50' name='begindate' id='begindate' value='".$begindate."'/></td>
             </tr>
             <tr>
                 <td><label for='enddate'>End Date:</label></td>
                 <td><input type='text' size='50' name='enddate' id='enddate' value='".$enddate."'/></td>
             </tr>
         </table>";

        echo "<fieldset>
            <legend>Supervisor</legend>
            <input type='hidden' name='supervisorHiddenName' id='supervisorHiddenName' value='".$supervisorName."'/>
            <input type='hidden' name='supervisorHiddenEmail' id='supervisorHiddenEmail' value='".$supervisorEmail."'/>
            <input type='hidden' name='supervisorHiddenDepartment' id='supervisorHiddenDepartment' value='".$supervisorDepartment."'/>
            <table>
                <tr>
                    <td><label for='supervisorName'>Name:</label></td>
                    <td><input type='text' size='50' name='supervisorName' id='supervisorName' value='".$supervisorName."' disabled/></td>
                </tr>
                <tr>
                    <td><label for='supervisorEmail'>Email:</label></td>
                    <td><input type='text' size='50' name='supervisorEmail' id='supervisorEmail' value='".$supervisorEmail."' disabled/></td>
                </tr>
                <tr>
                    <td><label for='supervisorDepartment'>Department:</label></td>
                    <td><input type='text' size='50' name='supervisorDepartment' id='supervisorDepartment' value='".$supervisorDepartment."' disabled/></td>
                </tr>
            </table>
        </fieldset>
        </fieldset>
        <fieldset>
            <legend>Workteam</legend>

            <div id='membros' >
            <input type='hidden' name='countTM' value='".count($memberIdentifiers)."' id='countTM' />
            <input type='hidden' name='newMember' id='newMember' value='false'/>
            ";
            //workteam antiga, enviar como HIDDEN
            for($i=0; $i<count($memberIdentifiers);$i++){
                echo "<input type='hidden' name='oldmemberName[".$i."]' id='oldmemberName".$i."' value='".$memberNames[$i]."'/>";
                echo "<input type='hidden' name='oldmemberIdentifier[".$i."]' id='oldmemberIdentifier".$i."' value='".$memberIdentifiers[$i]."'/>";
                echo "<input type='hidden' name='oldmemberEmail[".$i."]' id='oldmemberEmail".$i."' value='".$memberEmails[$i]."'/>";
            }
            //logMessage("MEMBER_NAMES:".print_r($memberNames));
            for($i=0; $i<count($memberIdentifiers);$i++){
                        echo "
                <div id='membro".$i."'>
                    <table id='table".$i."'>
                        <tr>
                            <td><label for='memberName".$i."'>Name:</label></td>
                            <td><input type='text' size='50' name='memberName[".$i."]' id='memberName".$i."' value='".$memberNames[$i]."' /></td>
                        </tr>
                        <tr>
                            <td><label for='memberIdentifier".$i."'>Identifier:</label></td>
                            <td> <input type='text' size='50' name='memberIdentifier[".$i."]' id='memberIdentifier".$i."' value='".$memberIdentifiers[$i]."' readonly/></td>

                        </tr>
                        <tr>
                            <td><label for='memberEmail".$i."'>Email:</label></td>
                            <td><input type='text' size='50' name='memberEmail[".$i."]' id='memberEmail".$i."' value='".$memberEmails[$i]."' /></td>
                        </tr>
                        </table>
                    <br/>
                    <br/>
                </div>   ";
                    }
        echo"

            </div>
            <div style='margin:7px;'>
                <button type='button' id='adicionarTeamMember'>Add</button>
                <button type='button' id='removerTeamMember'>Remove</button>
            </div>
        </fieldset>
        <fieldset>
            <legend>Abstract</legend>
            <textarea name='abstract' cols='100' rows='6'>".$abstract."</textarea>
        </fieldset>
        <fieldset>
            <legend>Ficheiros Atuais</legend>";
            for($i=0; $i<count($ficheiros);$i++){
                 echo "<li><a href=\""."../submissaoSip/".$ficheiros[$i]."\">".basename($ficheiros[$i])."</a></li>";
            }
            echo "
            <input type='hidden' name='deleteOldFiles' value='false' />
            <br/>
            <input type='checkbox' name='deleteOldFiles' value='true'>Apagar ficheiros atuais<br/>";
        echo"
        </fieldset>
        <fieldset>
            <legend>Deliverables</legend>
            ";
            echo"
            <div id='ficheiros'>";
            echo "
             <div id='ficheiro0'>
                <label for='fich0'>File 1: </label>
                <input type='file' name='fich[0]' id='fich0' />
                <br/>
                <br/>
             </div>
            </div>
            <br/>
            <div style='margin:7px;'>
                <button type='button' id='adicionarFicheiro'>Add</button>
                <button type='button' id='removerFicheiro'>Remove</button>
            </div>
        </fieldset>
            <br/>
            <input type='submit' value='Submit'/>

        </form>
    </body>
</html>";


/*
foreach($ficheiros as $f){
    echo "<li><a href=\""."../submissaoSip/".$f."\">".basename($f).PHP_EOL."</a></li>";
}

echo "</ol>";
for($i = 0, $c = count($ficheiros); $i < $c; $i++)
{
    $ficheiros[$i]="../submissaoSip/".$ficheiros[$i];
}
if(file_exists('zip'.$codProj.'.zip')){
create_zip($ficheiros,'zip'.$codProj.'.zip',true);
echo "<a href=\""."zip".$codProj.".zip"."\">Download PR (zip)</a>";
}
else{
create_zip($ficheiros,'zip'.$codProj.'.zip',false);
echo "</br>";
echo "<a href=\""."zip".$codProj.".zip"."\">Download PR (zip)</a>";
}
echo "</br>";
echo "</br>";
*/

echoGoBack();
echo "</body></html>";

function echoGoBack(){
echo "<address><a href='pagPrincipalSips.html'>Voltar atrás</a></address>";
}
function logMessage($message)
{
    echo "<script>console.log('LOG: ".$message."');</script>";
}

function getKeyName($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT palavrachave FROM projeto_submissao WHERE codProj='".$codProj."'");

     while ($linha = $query->fetch()){
         $string=$linha['palavrachave'];
        }
    return $string;
}

function getTitle($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT titulo FROM projeto_submissao WHERE codProj='".$codProj."'");

     while ($linha = $query->fetch()){
         $string=$linha['titulo'];
        }
    return $string;
}
function getSubtitle($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT subtitulo FROM projeto_submissao WHERE codProj='".$codProj."'");

     while ($linha = $query->fetch()){
         $string=$linha['subtitulo'];
        }
    return $string;
}
function getBeginDate($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT datainicio FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $string=$linha['datainicio'];
        }
    return $string;
}

function getEndDate($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
     $query = $bd->query("SELECT datafim FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $string=$linha['datafim'];
        }
    return $string;
}

function getSupervisorData($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
     $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $codEnunciado=$linha['codEnunciado'];
        }
    $query = $bd->query("SELECT codUC FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
     while ($linha = $query->fetch()){
         $codUC=$linha['codUC'];
        }
     $query = $bd->query("SELECT codProf FROM disciplina WHERE codUC='".$codUC."'");
     while ($linha = $query->fetch()){
         $codProf=$linha['codProf'];
        }
    $prof=array();
    $query = $bd->query("SELECT * FROM professor WHERE codProf='".$codProf."'");
     while ($linha = $query->fetch()){
         array_push($prof, $linha['nome']);
         array_push($prof, $linha['email']);
         array_push($prof, $linha['departamento']);
        }
    return $prof;
}

function getAbstract($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
     $query = $bd->query("SELECT resumo FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $string=$linha['resumo'];
        }
    return $string;
}
function getEnunciado($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $codEnunciado=$linha['codEnunciado'];
        }
     $query = $bd->query("SELECT descricao FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
     while ($linha = $query->fetch()){
         $string=$linha['descricao'];
        }
    return $string;
}
function getCodEnunciado($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codProj."'");
     while ($linha = $query->fetch()){
         $codEnunciado=$linha['codEnunciado'];
        }
    return $codEnunciado;
}
function getWorkTeamNames($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $codsAluno=getWorkTeamIdentifiers($codProj);
    $nomes=array();
    foreach($codsAluno as $codAluno){
        logMessage("COD_ALUNO:".$codAluno);
        $query = $bd->query("SELECT nome FROM aluno WHERE codAluno='".$codAluno."'");

        while ($linha = $query->fetch()){
         array_push($nomes, $linha['nome']);
        }
    }
    return $nomes;
}
function getWorkTeamEmails($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $codsAluno=getWorkTeamIdentifiers($codProj);
    $emails=array();
    foreach($codsAluno as $codAluno){
        logMessage("COD_ALUNO:".$codAluno);
        $query = $bd->query("SELECT email FROM aluno WHERE codAluno='".$codAluno."'");
        while ($linha = $query->fetch()){
             array_push($emails, $linha['email']);
            }
    }
    return $emails;
}
function getWorkTeamIdentifiers($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $query = $bd->query("SELECT codAluno FROM projeto_aluno WHERE codProj='".$codProj."'");
     $codsAluno=array();
     while ($linha = $query->fetch()){
         array_push($codsAluno, $linha['codAluno']);
         logMessage("Linha:".$linha['codAluno']);
        }
    return $codsAluno;
}
function getDeliverables($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $query = $bd->query("SELECT * FROM ficheiro WHERE codProj='".$codProj."'");
     $diretorias=array();
     while ($linha = $query->fetch()){
         array_push($diretorias, $linha['diretoria']);
        }
    return $diretorias;
}



/* creates a compressed zip file */
function create_zip($ficheiros,$destination,$overwrite) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($ficheiros)) {
		//cycle through each file
		foreach($ficheiros as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,(string)basename($file));
			logMessage("Ficheiro p/ zip: ".$file);
		}
		//debug
		logMessage( 'The zip archive contains '.$zip->numFiles.' files with a status of '.$zip->status);
		//close the zip -- done!
		$zip->close();

		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}
?>
