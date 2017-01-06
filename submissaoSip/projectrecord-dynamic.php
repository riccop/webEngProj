<?php
header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8');

$keyname = $_REQUEST['keyname'];
$title = $_REQUEST['title'];
$subtitle = $_REQUEST['subtitle'];
$begindate = $_REQUEST['begindate'];
$enddate = $_REQUEST['enddate'];
$abstract = $_REQUEST['abstract'];
$codEnunciado = $_REQUEST['enunciado'];
$supervisorName=$_REQUEST['supervisorName'];
$supervisorEmail=$_REQUEST['supervisorEmail'];
$supervisorDepartment=$_REQUEST['supervisorDepartment'];
$memberNames=$_REQUEST['memberName'];
$memberEmails=$_REQUEST['memberEmail'];
$memberIdentifiers=$_REQUEST['memberIdentifier'];
$deliverablesExist=false;

if (isset($_FILES['fich'])){
  $ficheiro=$_FILES["fich"];
  $deliverablesExist=true;
}

$GLOBALS['codProjGlobal'] = -1;

echo "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
<link rel='stylesheet' type='text/css' href='mystyles.css'>
      <title>Project Record</title><style>
                    body{background-color:#CCCCCC}
                </style></head>
   <body>";
//Os valores de texto são impressos na página como cabeçalhos
echo "<h1 align=\"center\">".$_REQUEST['keyname']."</h1><hr>";
echo "<h2 align=\"center\">".$_REQUEST['title']."</h2>";
echo "<h3 align=\"center\">".$_REQUEST['subtitle']."</h3>";
echo "<p align=\"center\" style=\"color:darkblue\"><b>".$_REQUEST['begindate']." - ".$_REQUEST['enddate']."</b></p>";
echo "<hr><hr>";
//é criada uma tabela para o supervisor, onde são apresentadas as informações
echo "<h3>Supervisor:</h3>";
echo"<table  cellpadding=\"2px\">
         <tbody><tr>
           <th>Nome</th>
            <th>Email</th>
            <th>Departmento</th>
         </tr>";
echo "<tr><td>".$_REQUEST['supervisorName']."</td>";
echo "<td><a href=\"mailto:".$_REQUEST['supervisorEmail']."\">".$_REQUEST['supervisorEmail']."</a></td>";
echo "<td>".$_REQUEST['supervisorDepartment']."</tr></table>";
echo "<hr><hr>";
echo "<h3>Workteam:</h3>";
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
echo $_REQUEST['abstract'];
echo "<hr><hr>";
echo "<h3>Deliverables:</h3>";
//<file path="site/index.html">site/index.html</file>
echo "<ol>";
//Os ficheiros aparecem como uma lista ordenada

//o ciclo permite percorrer todos os ficheiros enviados
//cada ficheiro é um item da lista e pode ser consultado com apenas um click
//quando o ficheiro já se encontra no servidor, aparece um aviso que esse ficehiro já está no servidor
$tudoOk=true;
if($deliverablesExist==true){
    for ($i = 0 ; $i <count($ficheiro["name"]); $i++){
    if($ficheiro["error"][$i]>0){
      echo "<p>Erro a carregar ficheiro. Erro: ". $ficheiro["error"][$i]. "</p><br/>";
      $deliverablesExist=false;
    #imprime o valor do erro caso exista um erro
    }
    else
    {
        if(file_exists("upload/". $ficheiro["name"][$i])){
        #a funcao file_exists  verifica a existencia do ficheiro
        //echo "<li> File ".$ficheiro["name"][$i]." already exists in server.</li>";
          unlink("upload/". $ficheiro["name"][$i]);
        //$tudoOk=false;
        }
            move_uploaded_file($ficheiro["tmp_name"][$i] , "upload/".$ficheiro["name"][$i]);
            //echo "<li><a href=\""."upload/".$ficheiro["name"][$i]. "\">"."upload/".$ficheiro["name"][$i]."</a></li>";
       }
    }
}
$diretoriasExistem=false;
if(!firstSubmission($codEnunciado,$memberIdentifiers)){
  //echo 'PRIMEIRA SUBMISSAO - TRUE';
  echo '<script language="javascript">';
  echo 'alert("Atenção: Só pode haver uma submissão por cada Workteam!\nPor favor tente novamente.");';
  echo 'window.location.href="formulario-projectrecord-dynamic.php?enunciado='.$codEnunciado.'";';
  echo '</script>';

   //echo '<p>Atenção: Só pode haver uma submissão por cada Workteam!</p>';
   //echo '<p>Por favor tente novamente.</p>';
}
if($tudoOk ){

        if(!file_exists('upload/'.$codEnunciado)){
    	   mkdir('upload/'.$codEnunciado,0777);
    	}
        if(firstSubmission($codEnunciado,$memberIdentifiers)){
        //echo "ENTREI IF <br/>";
        $diretorias=checkDBandInsertData($codEnunciado,
                                          $keyname,
                                          $title,
                                          $subtitle,
                                          $begindate,
                                          $enddate,
                                          $abstract,
                                          $memberNames,
                                          $memberEmails,
                                          $memberIdentifiers,
                                          $ficheiro,
                                          $deliverablesExist);
        if(!prExists($ficheiro)){
        //Escrever para XML
          logMessage("PR DOSEN'T exist");
        geraPrXML($keyname,
                  $title,
                  $subtitle,
                  $begindate,
                  $enddate,
                  $supervisorName,
                  $supervisorEmail,
                  $supervisorDepartment,
                  $memberIdentifiers,
                  $memberNames,
                  $memberEmails,
                  $ficheiro,
                  $deliverablesExist,
                  'upload/'.$codEnunciado.'/'.$GLOBALS['codProjGlobal'].'/pr.xml');

                  //inserir o pr.xml como deliverable
                  if(file_exists('upload/'.$codEnunciado.'/'.$GLOBALS['codProjGlobal'].'/pr.xml')){
                    insertFile($GLOBALS['codProjGlobal'],'pr.xml','upload/'.$codEnunciado.'/'.$GLOBALS['codProjGlobal'].'/pr.xml');
                  }

        }
        else{
          logMessage("PR exists");
        }
        if(count($diretorias)>0){
            $diretoriasExistem=true;
          }
          else{$diretoriasExistem=false;}
        }
        else
        {
          $diretoriasExistem=false;
          //echo '<p>Atenção: Só pode haver uma submissão por cada Workteam!</p>';
          //echo '<p>Por favor tente novamente.</p>';
        }
}
if($diretoriasExistem==true){

  foreach (getFiles($GLOBALS['codProjGlobal']) as $dir) {
      echo "<li><a href=\"$dir\" target='_blank'>".basename($dir).PHP_EOL."</a></li>";
  }
}

echo "</ol>";

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


function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}



function echoGoBack(){
echo "<address><a href='pagPrincipal.html'>Voltar atrás</a></address>";
}
function logMessage($message)
{
    echo "<script>console.log('LOG: ".$message."');</script>";
}

function getFiles($codProj){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $ficheiros=array();

      $query = $bd->query("SELECT diretoria FROM ficheiro WHERE codProj='".$codProj."'");

      while ($linha = $query->fetch()){
       array_push($ficheiros, $linha['diretoria']);
      }
    return $ficheiros;
}

function prExists($ficheiro){
for ($i = 0 ; $i <count($ficheiro["name"]); $i++){
  if($ficheiro["name"][$i]=='pr.xml'){
    return true;
    }
  }
  return false;
}
function deleteFiles($projectRecord){
      logMessage("Deleting files...");
      $file_paths=array();
      foreach($projectRecord->deliverables->file as $f)
	  {
	     array_push($file_paths, (string)"upload/".$f['path']);
	  }
	  foreach($file_paths as $path){
     	  if(file_exists($path))
     	  {
     	   logMessage("Deleting file: ".$path);
     	   unlink($path);
     	  }
	   }
}

function firstSubmission($codEnunciado, $memberIdentifiers){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

 // echo "Entrei primeira submission";
     $query = $bd->query("SELECT codProj FROM projeto_submissao WHERE codEnunciado='".$codEnunciado."'");
     $codsProj=array();
     $verifications=array();
     while ($linha = $query->fetch()){
          array_push($codsProj,$linha['codProj']);
          //echo "cod Projeto SUBMETIDOS para enunciado".$linha['codProj'].'<br/>';
        }
      //verificar cada workteam
      foreach ($codsProj as $codProj) {
        //echo "NOVA submissao <br/>";
        $query = $bd->query("SELECT codAluno FROM projeto_aluno WHERE codProj='".$codProj."'");
        $workteam=array();
        while ($linha = $query->fetch()){
            array_push($workteam,$linha['codAluno']);
            //echo "cod ALUNO: ".$linha['codAluno'].'<br/>';
          }
        //verificar que o array workteam contem todos os memberIdentifiers
          $workteamExists=true;
          for ($i=0; $i < count($memberIdentifiers); $i++) {
           //print_r($workteam);
           //echo "Identifier: ".$memberIdentifiers[$i];
            if(!in_array($memberIdentifiers[$i], $workteam)){
              $workteamExists=false;
             // echo "A workteam NAO existe.";
            }
          }
          if($workteamExists && count($workteam)!=count($memberIdentifiers))
          {
            $workteamExists=false;
          }
          array_push($verifications, $workteamExists);
         // echo "FIM submissao <br/>";
      }

    if(in_array(true, $verifications)){
      return false;
    }
    else{return true;}
    return false;
}

function checkDBandInsertData($codEnunciado,$keyname,$title,$subtitle,$begindate,$enddate,$abstract,$memberNames,$memberEmails,$memberIdentifiers,$ficheiros,$deliverablesExist){
$codProj=insertProjectSubmission($codEnunciado,null,$keyname,$title,$subtitle,$begindate,$enddate,$abstract);

$GLOBALS['codProjGlobal']=$codProj;

$diretorias=array();
for($i = 0, $c = count($memberNames); $i < $c; $i++)
{
	   //verificar se o nº aluno já existe na DB
        if(!studentExists($memberIdentifiers[$i])){
            //inserir aluno DB
            insertStudent($memberIdentifiers[$i],$memberNames[$i],$memberEmails[$i]);
        }
        insertProjectStudent($codProj,$memberIdentifiers[$i]);
}
	//agora inserir o projeto aluno com os team menbers
	   mkdir('upload/'.(string)$codEnunciado."/".(string)$codProj,0777);
	//precisamos de percorer os ficheiros, move-los para a diretoria final, e inserir os ficheiros na base de dados
	 if($deliverablesExist){
     for ($i = 0 ; $i <count($ficheiros["name"]); $i++){
  	        insertFile($codProj, $ficheiros["name"][$i], 'upload/'.$codEnunciado.'/'.$codProj.'/'.$ficheiros["name"][$i]);
  	       logMessage("Nome ficheiro: ".$ficheiros["name"][$i]);
  	       rename('upload/'.$ficheiros["name"][$i], 'upload/'.$codEnunciado.'/'.$codProj.'/'.$ficheiros["name"][$i]);
          array_push($diretorias, 'upload/'.$codEnunciado.'/'.$codProj.'/'.$ficheiros["name"][$i]);

  	 }
  }
	 return $diretorias;
}

function insertProjectStudent($codProj,$codAluno){
      $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
      $query = $bd->prepare("INSERT INTO projeto_aluno VALUES (:codProj, :codAluno)");
		$query->bindValue(":codProj", $codProj, PDO::PARAM_STR);
		$query->bindValue(":codAluno", $codAluno, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();
}


function insertFile($codProj,$descricao,$diretoria){

       $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
       $query = $bd->prepare("INSERT INTO ficheiro VALUES (:codFicheiro, :codProj, :descricao, :diretoria)");
	    $query->bindValue(":codFicheiro", null, PDO::PARAM_STR);
		$query->bindValue(":codProj", $codProj, PDO::PARAM_STR);
		$query->bindValue(":descricao", $descricao, PDO::PARAM_STR);
		$query->bindValue(":diretoria", $diretoria, PDO::PARAM_STR);
		$query->execute();
		$query->closeCursor();

}


function studentExists($codigo)
{
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

     $query = $bd->query("SELECT codAluno FROM aluno WHERE codAluno='".$codigo."'");
     while ($linha = $query->fetch()){
                if($linha['codAluno']==$codigo){
                    return true;
                }
        }
    return false;
}
function insertStudent($codAluno,$nome,$email){
    	//falta testar
    	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    	$query = $bd->prepare("INSERT INTO aluno VALUES (:codAluno, :email, :nome)");
	    $query->bindValue(":codAluno", $codAluno, PDO::PARAM_STR);
		$query->bindValue(":email", $email, PDO::PARAM_STR);
		$query->bindValue(":nome", $nome, PDO::PARAM_STR);

		$query->execute();
		$query->closeCursor();
		logMessage("Inseriu aluno");
    }
function insertProjectSubmission($codEnunciado,$codProjeto,$palavraChave,$titulo,$subTitulo,$dataInicio,$dataFim,$resumo){
//falta testar
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    	$query = $bd->prepare("INSERT INTO projeto_submissao VALUES (:codProj, :codEnunciado, :palavrachave, :titulo, :subtitulo, :datainicio, :datafim, :resumo)");
	    $query->bindValue(":codProj", $codProjeto, PDO::PARAM_STR);
		$query->bindValue(":codEnunciado", $codEnunciado, PDO::PARAM_STR);
		$query->bindValue(":palavrachave", $palavraChave, PDO::PARAM_STR);
		$query->bindValue(":titulo", $titulo, PDO::PARAM_STR);
		$query->bindValue(":subtitulo", $subTitulo, PDO::PARAM_STR);
		$query->bindValue(":datainicio", $dataInicio, PDO::PARAM_STR);
		$query->bindValue(":datafim", $dataFim, PDO::PARAM_STR);
		$query->bindValue(":resumo", $resumo, PDO::PARAM_STR);
		$query->execute();

		$result=$bd->lastInsertId();
    logMessage("passei no insert e codEnunciado=".$codEnunciado." e codProj=".$result);
		$query->closeCursor();

		//$query = $bd->prepare("SELECT ID AS ()");
		//$query->execute();
		//$result=$query->fetch();
		logMessage("Resul: ".$result);
		return $result;
    }

    function direxists($dirname, $serverDir){
        if(strcmp($dirname,$serverDir)===0)
        {return true;}
        else
        {return false;}
    }


    function getAsXMLContent($xmlElement)
{
  $content=$xmlElement->asXML();

  $end=strpos($content,'>');
  if ($end!==false)
  {
    $tag=substr($content, 1, $end-1);
    return str_replace(array('<'.$tag.'>', '</'.$tag.'>'), '', $content);
  }
  else
    return '';
}


function geraPrXML($keyname,$title,$subtitle,$begindate,$enddate,$supervisorName,$supervisorEmail,$supervisorDepartment,$memberIdentifiers,$memberNames, $memberEmails,$files,$deliverablesExist,$filePath){
    logMessage("Caminho: ".$filePath);

    $projectrecord = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><project-record/>');
    //$projectRecord -
    $meta = $projectrecord->addChild('meta');
    $meta->addChild('keyname',$keyname);
    $meta->addChild('title',$title);
    $meta->addChild('subtitle',$subtitle);
    $meta->addChild('begindate',$begindate);
    $meta->addChild('enddate',$enddate);
    $supervisor=$meta->addChild('supervisor');

    //supervisor
    $supervisor->addChild('name',$_REQUEST['supervisorName']);
    $supervisor->addChild('email',$_REQUEST['supervisorEmail']);
    $supervisor->addChild('department',$_REQUEST['supervisorDepartment']);

    $workteam = $projectrecord->addChild('workteam');
    //fazer ciclo para cada elemento da workteam.
    for ($i=0; $i < count($memberIdentifiers); $i++) {
     $member= $workteam->addChild('member');
     $member->addChild('name',$memberNames[$i]);
     $member->addChild('identifier',$memberIdentifiers[$i]);
     $member->addChild('email',$memberEmails[$i]);
    }
    $abstract = $projectrecord->addChild('abstract',$_REQUEST['abstract']);
    $deliverables = $projectrecord->addChild('deliverables');

    //$files = $projectrecord->addChild('files');
    if($deliverablesExist){
        for ($i=0; $i < count($files['name']); $i++) {
          $file = $deliverables->addChild('file',basename($files['name'][$i]));
          $file->addAttribute('path',$files['name'][$i]);
        }
    }
    //  $abstract->addChild('texto',$_REQUEST['texto']);
   // $deliverables->addChild('hash',$_REQUEST['hash']);
    $projectrecord->asXml($filePath);

}

?>
