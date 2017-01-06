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
$codEnunciado = getEnunciado($codProj);
$memberNames= getWorkTeamNames($codProj);
$memberEmails=getWorkTeamEmails($codProj);
$memberIdentifiers=getWorkTeamIdentifiers($codProj);
$ficheiros=getDeliverables($codProj);


echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">

      <title>Project Record</title><style>
                    body{background-color:#CCCCCC}
                </style>
                <link rel='stylesheet' type='text/css' href='mystyles.css'>

                </head>
   <body>";
//Os valores de texto são impressos na página como cabeçalhos
echo "<h1 align=\"center\">".$keyname."</h1><hr>";
echo "<h2 align=\"center\">".$title."</h2>";
echo "<h3 align=\"center\">".$subtitle."</h3>";
echo "<p align=\"center\" style=\"color:darkblue\"><b>".$begindate." - ".$enddate."</b></p>";
echo "<hr><hr>";
//é criada uma tabela para o supervisor, onde são apresentadas as informações
echo "<h3>Supervisor:</h3>";
echo"      <table cellpadding=\"2px\">
         <tbody><tr>
           <th>Nome</th>
            <th>Email</th>
            <th>Departmento</th>
         </tr>";
echo "<tr><td>".$supervisorName."</td>";
echo "<td><a href=\"mailto:".$supervisorEmail."\">".$supervisorEmail."</a></td>";
echo "<td>".$supervisorDepartment."</tr></table>";
echo "<hr><hr>";
echo "<h3>Work Team:</h3>";
//as informações dos membros da equipa são armazenadas em 3 arrays, cada um aparesenta os nomes, emails e identificadores,
// que podem ser obtidos a partir do índice do array

echo "<table cellpadding=\"2px\">
         <tbody><tr>
           <th>Número</th>
            <th>Nome</th>
            <th>Email</th>
         </tr>";
//o ciclo permite adicionar as informações de cada membro como uma linha da tabela
for($i = 0, $c = count($memberNames); $i < $c; $i++)
{
echo "<tr><td>".$memberIdentifiers[$i]."</td>";
echo "<td>".$memberNames[$i]."</td>";
echo "<td><a href=\"mailto:".$memberEmails[$i]."\">".$memberEmails[$i]."</a></td></tr>";
//echo "<br/><br/>";
}
echo "</table>";
echo "<hr><hr>";
echo "<h3>Abstract:</h3>";
logMessage($abstract);
echo $abstract;
echo "<hr><hr>";
echo "<h3>Deliverables:</h3>";
//<file path="site/index.html">site/index.html</file>
echo "<ol>";
//Os ficheiros aparecem como uma lista ordenada

//o ciclo permite percorrer todos os ficheiros enviados
//cada ficheiro é um item da lista e pode ser consultado com apenas um click
//quando o ficheiro já se encontra no servidor, aparece um aviso que esse ficehiro já está no servidor
//FAZER ISTO PARA CADA FICHEIRO!!!!
/*
foreach ($diretorias as $dir) {

}
*/
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


echoGoBack();
/*
echo "TESTES";
echo "<hr/>";
echo "<pre>";
print_r($_REQUEST);
echo "____________________________________________________________________";
print_r($_FILES);
echo "</pre>";
*/
echo "</body></html>";

function echoGoBack(){
echo "<address><a href='pagPrincipal.html'>Voltar atrás</a></address>";
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
