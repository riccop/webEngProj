<?php
/*
if($_FILES["ficheiro"]["error"]>0){
    echo "Erro: ". $_FILES["ficheiro"]["error"]. "<br/>";
#imprime o valor do erro caso exista um erro
}
else
{
#echo "Upload (nome original): ".$_FILES["ficheiro"]["name"]."<br/>";
#echo "Type: ".$_FILES["ficheiro"]["type"]."<br/>";
#echo "Size: ".($_FILES["ficheiro"]["size"]/1024)." Kb<br/>";
#echo "Stored in: ".$_FILES["ficheiro"]["tmp_name"]."<br/>";

    if(file_exists("upload/". $_FILES["ficheiro"]["name"])){
    #a funcao file_exists  verifica a existencia do ficheiro
    echo "<p>Erro: Ficheiro já existente...</p>";
    }
    else{
        move_uploaded_file($_FILES["ficheiro"]["tmp_name"] , "upload/".$_FILES["ficheiro"]["name"]);
        echo "<p>Ficheiro guardado em: "."upload/".$_FILES["ficheiro"]["name"]."</p>";
    }
}
*/
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
$codEnunciado=$_REQUEST['enunciado'];


if($_FILES["ficheiro"]["error"]>0){
    echo "Erro: ". $_FILES["ficheiro"]["error"]. "<br/>";
    echoGoBack();
#imprime o valor do erro caso exista um erro
}
else{
    if($_FILES["ficheiro"]["name"]) {

        if(file_exists("upload/". $_FILES["ficheiro"]["name"])){
       #a funcao file_exists  verifica a existencia do ficheiro
       echo "<p>Erro: Ficheiro já existente...</p>";
       echoGoBack();

       }
        else{
    	$filename = $_FILES["ficheiro"]["name"];
    	$source = $_FILES["ficheiro"]["tmp_name"];
    	$type = $_FILES["ficheiro"]["type"];

    	$name = explode(".", $filename);
    	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    	foreach($accepted_types as $mime_type) {
    		if($mime_type == $type) {
    			$okay = true;
    			break;
    		}
    	}

    	$continue = strtolower($name[1]) == 'zip' ? true : false;
    	if(!$continue) {
    		$message = "O ficheiro que está a tentar submeter não está no formato .zip. Por favor tente de novo.";
    		echo "<p>".$message."</p>";
    		echo "<address><a href='formulario-ficheiro.html'>Voltar atrás</a></address>";
    	}
        else{
    	$target_path = "upload/".$filename;  // change this to the correct site path
    	if(move_uploaded_file($source, $target_path)) {
    		$zip = new ZipArchive();
    		$x = $zip->open($target_path);

    		if ($x === true && prExists($zip)===true) {

    		     if(!file_exists('upload/'.$codEnunciado)){
    		          mkdir('upload/'.$codEnunciado,0777);
    		      }

    			$zip->extractTo("upload/"); // change this to the correct site path
    			$zip->close();
    			unlink($target_path);
    			//agora podemos abrir o XML e verificar se os ficheiros lá especificados existem
	            $projectRecord = simplexml_load_file('upload/pr.xml');
	             if(deliverablesExist($projectRecord)){
	               logMessage("TODOS OS deliverables existem no ZIP");
	               //é necessário veriricar os membros da workteam, e introduzi-los na base de dados
	           //CHAMAR ESTE METODO->checkDBandInsertData($projectRecord)

	           checkDBandInsertData($projectRecord,$codEnunciado);
	           //criar projeto aluno por cada
	          // insertProjectSubmission($codEnunciado,null);

	           //$codProj = ;
	          // mkdir('upload/'.$codEnunciado."/".$codProj,0777);

	           $message = "O seu ficheiro .zip foi carregado para o servidor e descompactado.";
           		//echo "<p>".$message."</p>";
           		logMessage($message);
           		echo "<p>".$message."</p>";
           		echoGoBack();
           		}


	             else{
	             //neste caso precisamos de eliminar os ficheiros que foram guardados;
	             deleteFiles($projectRecord);
	             echo "<p>Faltam ficheiros no ZIP, tente de novo.</p>";
	             echoGoBack();

	             }

    		}else{ 	$message = "Surgiu um problema no upload. Por favor tente de novo.";
           	echo "<p>".$message."</p>";
           	echoGoBack();}
    		}
         else {
           	$message = "Surgiu um problema no upload. Por favor tente de novo.";
           	echo "<p>".$message."</p>";
           	echoGoBack();
           	}
          }
        }
    }
}
//checks if project record exists in the zip file
function prExists($zip)
{
    for($i=0; $i< $zip->numFiles ;$i++){
        $stat=$zip->statIndex($i);
        //echo "NOME ficheiro=".(basename($stat['name']) . PHP_EOL);
        logMessage(basename($stat['name']));
        if(strcmp("pr.xml" , basename($stat['name']))===0)
        {
            logMessage("entrei if pr.xml");
            return true;
        }
    }
    return false;
}
function deliverablesExist($projectRecord)
{
    foreach($projectRecord->deliverables->file as $f)
	  {
	       //echo "FILE PATH=".$f['path'];
	       if(!file_exists("upload/".$f['path'])){
	       //echo "ficheiro nao existe!";

	       return false;
	       }
	  }
	  return true;
}
function echoGoBack(){
echo "<address><a href='pagPrincipal.html'>Voltar atrás</a></address>";
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

function checkDBandInsertData($projectRecord,$codEnunciado){

    $codProj=insertProjectSubmission($codEnunciado,null,$projectRecord->meta->keyname,$projectRecord->meta->title,$projectRecord->meta->subtitle,$projectRecord->meta->begindate,$projectRecord->meta->enddate,getAsXMLContent($projectRecord->abstract));
    foreach($projectRecord->workteam->member as $m){
	   //verificar se o nº aluno já existe na DB
        if(!studentExists($m->identifier)){
            //inserir aluno DB
            insertStudent($m->identifier,$m->name,$m->email);
        }
        insertProjectStudent($codProj,$m->identifier);
	}
	//agora inserir o projeto aluno com os team menbers
	   mkdir('upload/'.(string)$codEnunciado."/".(string)$codProj,0777);
	//precisamos de percorer os ficheiros, movelos para a diretoria final, e inserir os ficheiros na base de dados
	 foreach($projectRecord->deliverables->file as $f) {
	        insertFile($codProj,$f->file,'upload/'.$codEnunciado.'/'.$codProj.'/'.$f['path']);
	       logMessage("Nome ficheiro: ".$f->file);
	       rename('upload/'.$f['path'],'upload/'.$codEnunciado.'/'.$codProj.'/'.$f['path']);
	 }


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




?>
