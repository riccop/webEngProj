<?php
header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');
mb_regex_encoding('UTF-8');

$codProjeto = $_REQUEST['projeto'];
$keyname = $_REQUEST['keyname'];
$title = $_REQUEST['title'];
$subtitle = $_REQUEST['subtitle'];
$begindate = $_REQUEST['begindate'];
$enddate = $_REQUEST['enddate'];
$abstract = $_REQUEST['abstract'];
$codEnunciado = $_REQUEST['enunciado'];


$deleteFiles=$_REQUEST['deleteOldFiles'];

$oldMemberNames=$_REQUEST['oldmemberName'];
$oldMemberEmails=$_REQUEST['oldmemberEmail'];
$oldMemberIdentifiers=$_REQUEST['oldmemberIdentifier'];

//Obter valores dos novos membros da equipa
$newMembers=$_REQUEST['newMember'];
//if($newMembers=='true'){
$memberNames=$_REQUEST['memberName'];
$memberEmails=$_REQUEST['memberEmail'];
$memberIdentifiers=$_REQUEST['memberIdentifier'];


/*
echo '<br/>';
print_r($memberNames);
echo '<br/>';
print_r($memberEmails);
echo '<br/>';
print_r($memberIdentifiers);
echo '<br/>';

//}


echo '<br/>';
print_r($oldMemberNames);
echo '<br/>';
print_r($oldMemberEmails);
echo '<br/>';
print_r($oldMemberIdentifiers);
echo '<br/>';
print_r($deleteFiles);
echo '<br/>';
*/
//print_r($_FILES["fich"]);


//echo "<pre>";
//print_r($_FILES['fich']);
//echo "</pre>";
if (isset($_FILES['fich'])) {
  logMessage("Entrei IFFF");
  $ficheiro=$_FILES["fich"];
}
  $ficheiro=$_FILES["fich"];




echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">

      <title>Project Record</title><style>
                    body{background-color:#CCCCCC}
                </style>

<link rel='stylesheet' type='text/css' href='mystyles.css'>

                </head>
   <body>";
//Os valores de texto são impressos na página como cabeçalhos
echo "<h1 align=\"center\">".$_REQUEST['keyname']."</h1><hr>";
echo "<h2 align=\"center\">".$_REQUEST['title']."</h2>";
echo "<h3 align=\"center\">".$_REQUEST['subtitle']."</h3>";
echo "<p align=\"center\" style=\"color:darkblue\"><b>".$_REQUEST['begindate']." - ".$_REQUEST['enddate']."</b></p>";
echo "<hr><hr>";
//é criada uma tabela para o supervisor, onde são apresentadas as informações
echo "<h3>Supervisor:</h3>";
echo"      <table cellpadding=\"2px\">
         <tbody><tr>
           <th>Nome</th>
            <th>Email</th>
            <th>Departmento</th>
         </tr>";
echo "<tr><td>".$_REQUEST['supervisorHiddenName']."</td>";
echo "<td><a href=\"mailto:".$_REQUEST['supervisorHiddenEmail']."\">".$_REQUEST['supervisorHiddenEmail']."</a></td>";
echo "<td>".$_REQUEST['supervisorHiddenDepartment']."</tr></table>";
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
//if (is_uploaded_file($_FILES['fich']['tmp_name'])) {//verificar se foram adicionados DELIVERABLES

    for ($i = 0 ; $i <count($ficheiro["name"]); $i++){
    if($ficheiro["error"][$i]>0){
      if($ficheiro["error"][$i]==4 )
        echo "<p>Não foi carregado nenhum ficheiro.</p>";
      else
        echo "<p>Erro a carregar ficheiro. Erro: ". $ficheiro["error"][$i]. "</p><br/>";

      $tudoOk=false;
    //imprime o valor do erro caso exista um erro
    }
    else
    {
        if(file_exists("../submissaoSip/upload/". $ficheiro["name"][$i])){
        #a funcao file_exists  verifica a existencia do ficheiro
        echo "<li>Error: File ".$ficheiro["name"][$i]." already exists in server.</li>";
        $tudoOk=false;
        }
        else{
            move_uploaded_file($ficheiro["tmp_name"][$i] , "../submissaoSip/upload/".$ficheiro["name"][$i]);
            //echo "<li><a href=\""."upload/".$ficheiro["name"][$i]. "\">"."upload/".$ficheiro["name"][$i]."</a></li>";

            }
       }
  }

if($tudoOk ){
//echo "ficheiro foi CARREGADO";
/*
        if(!file_exists('../submissaoSip/upload/'.$codEnunciado)){
    	   mkdir('../submissaoSip/upload/'.$codEnunciado,0777);
    	}
      */


        $diretorias=checkDBandInsertData($codEnunciado,
                                          $codProjeto,
                                          $keyname,
                                          $title,
                                          $subtitle,
                                          $begindate,
                                          $enddate,
                                          $abstract,
                                          $oldMemberNames,
                                          $oldMemberIdentifiers,
                                          $oldMemberEmails,
                                          $memberNames,
                                          $memberEmails,
                                          $memberIdentifiers,
                                          $ficheiro,
                                          $newMembers,
                                          $deleteFiles);
  foreach ($diretorias as $dir) {
  echo "<li><a href=\"$dir\" target='_blank'>".basename($dir)."</a></li>";
  logMessage("Entrei lista de fichieros!!!");
}
}
else{
   //echo "<p>Surgiu um problema a guardar os ficheiros, por favor tente novamente.</p>";

   echoGoBack();
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

function echoGoBack(){
echo "<address><a href='pagPrincipalSips.html'>Voltar atrás</a></address>";
}
function logMessage($message)
{
    echo "<script>console.log('LOG: ".$message."');</script>";
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
function checkDBandInsertData($codEnunciado,$codProjeto,$keyname,$title,$subtitle,$begindate,$enddate,$abstract,$oldMemberNames,$oldMemberIdentifiers,$oldMemberEmails,$memberNames,$memberEmails,$memberIdentifiers,$ficheiros,$newMembers,$deleteFiles){
//$codProj=insertProjectSubmission($codEnunciado,null,$keyname,$title,$subtitle,$begindate,$enddate,$abstract);

$diretorias=array();
//Atualizar os membros novos
  for($i = 0, $c = count($memberIdentifiers); $i < $c; $i++){
      if(studentExists($memberIdentifiers[$i])){
      updateStudent($memberIdentifiers[$i],$memberNames[$i],$memberEmails[$i]);
      }
      else{
        if($newMembers=='true'){
          insertStudent($memberIdentifiers[$i],$memberNames[$i],$memberEmails[$i]);
          insertProjectStudent($codProjeto,$memberIdentifiers[$i]);
        }
      }
  }

/*
//Adicionar novos elementos da workteam
if($newMembers=='true'){
 for($i = 0, $c = count($memberIdentifiers); $i < $c; $i++)
  {
    //verificar se o nº aluno já existe na DB
        if(!studentExists($memberIdentifiers[$i])){
            //inserir aluno DB
            insertStudent($memberIdentifiers[$i],$memberNames[$i],$memberEmails[$i]);
        }
        insertProjectStudent($codProjeto,$memberIdentifiers[$i]);
  }
}*/
if($deleteFiles=='true'){
  //APAGAR FICHEIROS ANTIGOS
  $files=getFiles($codProjeto);
  if(count($files)>0){
      foreach($files as $path){
        if(file_exists('../submissaoSip/'.$path))
        {
         logMessage("Deleting file: ".'../submissaoSip/'.$path);
         deleteFile($path);

         if(!fileExists($path)){
         unlink('../submissaoSip/'.$path);
        }
         //APAGAR ficheiro na base de dados
        echo "<p>Ficheiro '".basename($path)."' apagado com sucesso.</p>";
        }
    }
  }
  else
    {
    logMessage("Não existem ficheiros associados a este projeto para serem apagados");
    echo "<p>Não existem ficheiros associados a este projeto para serem apagados</p>";
    }
}
/*
   if (!file_exists('../submissaoSip/upload/'.(string)$codEnunciado."/".(string)$codProjeto)){
     mkdir('../submissaoSip/upload/'.(string)$codEnunciado."/".(string)$codProjeto,0777);
   }
  */
  //precisamos de percorer os ficheiros, move-los para a diretoria final, e inserir os ficheiros na base de dados


      logMessage("Inserir ficheiro!!!");
   for ($i = 0 ; $i <count($ficheiros["name"]); $i++){
        logMessage("Entrei FOR ficheiros");
        if(file_exists('../submissaoSip/upload/'.$codEnunciado.'/'.$codProjeto.'/'.$ficheiros["name"][$i])){
          echo "<p>O ficheiro já se encontra guardado.</p>";
        }else{
        insertFile($codProjeto, $ficheiros["name"][$i],  'upload/'.$codEnunciado.'/'.$codProjeto.'/'.$ficheiros["name"][$i]);
        logMessage("Nome ficheiro: ".$ficheiros["name"][$i]);
        //TESTAR ESTA PARTE COM A DIRETORIA ../submissaoSip/
        rename('../submissaoSip/upload/'.$ficheiros["name"][$i], '../submissaoSip/upload/'.$codEnunciado.'/'.$codProjeto.'/'.$ficheiros["name"][$i]);
        array_push($diretorias, '../submissaoSip/upload/'.$codEnunciado.'/'.$codProjeto.'/'.$ficheiros["name"][$i]);
      }
     }


        updateMetadata($codProjeto,$keyname,$title,$subtitle,$begindate,$enddate,$abstract);

	   	  return $diretorias;
}

function updateMetadata($codProj,$keyname,$title,$subtitle,$begindate,$enddate,$abstract){

   $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("UPDATE projeto_submissao SET ".
  "codProj='".$codProj."', ".
  "palavrachave='".$keyname."', ".
  "titulo='".$title."', ".
  "subtitulo='".$subtitle."', ".
  "datainicio='".$begindate."', ".
  "datafim='".$enddate."', ".
  "resumo='".$abstract."' ".
  "WHERE codProj='".$codProj."'"
  );
  $projetoSubmissao = $query->fetch();
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

function fileExists($diretoria){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $ficheiros=array();

        $query = $bd->query("SELECT * FROM ficheiro WHERE diretoria='".$diretoria."'");

      while ($linha = $query->fetch()){
        if($diretoria==$linha['diretoria']){
          return true;
        }

      }
    return false;
}

function deleteFile($diretoria){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $ficheiros=array();

        $query = $bd->query("DELETE FROM ficheiro WHERE diretoria='".$diretoria."'");
    $apagar=$query->fetch();
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

function updateStudent($codAluno,$nome,$email){
  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
  $query = $bd->query("UPDATE aluno SET ".
  "codAluno='".$codAluno."', ".
  "nome='".$nome."', ".
  "email='".$email."' ".
  "WHERE codAluno='".$codAluno."'"
  );
  $aluno = $query->fetch();
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
		logMessage("passei no insert e codEnunciado=".$codEnunciado." e codProj=".$codProjeto);
		$result=$bd->lastInsertId();
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

/*
function geraPrXML(){
    $projectRecord =
    $meta = $projectrecord->addChild('meta');
    $meta->addChild('keyname',$_REQUEST['keyname']);
    $meta->addChild('title',$_REQUEST['title']);
    $meta->addChield

    //fazer ciclo para workteam
    $workteam = $projectrecord->addChild('workteam');
    $abstract = $projectrecord->addChild('abstract');
    $deliverables = $projectrecord->addChild('deliverables');
    $files = $projectrecord->addChild('files');

$_REQUEST['subtitle']
$_REQUEST['begindate'] $_REQUEST['enddate']

    $abstract->addChild('texto',$_REQUEST['texto']);
    $deliverables->addChild('hash',$_REQUEST['hash']);
}
*/
?>
