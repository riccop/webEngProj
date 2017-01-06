<?php
//Apagar ficheiros
//apaga a entrada da submissao da base de dados
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
      $codProj = $_REQUEST['submissao'];
      $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

      $query = $bd->query("DELETE FROM projeto_aluno WHERE codproj='".$codProj."'");
      //apagar ficheiros da diretoria
      removeFiles($codProj);
      $query = $bd->query("DELETE FROM ficheiro WHERE codproj='".$codProj."'");
      $query = $bd->query("DELETE FROM projeto_submissao WHERE codproj='".$codProj."'");
	     echo "<p>Submissão ".$codProj." removida com sucesso.  </p><p><a href='pagPrincipalSips.html'>Voltar ao início</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada.</p><p><a href='pagPrincipalSips.html'>Voltar ao início</a></p>";
    }
    function getCodEnunciado($codProj){
      $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
      $query = $bd->query("SELECT codEnunciado FROM projeto_submissao WHERE codProj='".$codProj."'");
      $codEnunciado = $query->fetch();
      return $codEnunciado['codEnunciado'];
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
    function removeFiles($codProj){
      //CONCATENAR: '../submissaoSip/';
        if(file_exists('../submissaoSip/upload/'.getCodEnunciado($codProj).'/'.$codProj)){
          $files = glob('../submissaoSip/upload/'.getCodEnunciado($codProj).'/'.$codProj.'/*'); // get all file names
          foreach($files as $file){ // iterate files
            if(is_file($file))
              unlink($file); // delete file
              logMessage("Deleting file: ".$file);
          }
          rmdir('../submissaoSip/upload/'.getCodEnunciado($codProj).'/'.$codProj);
          logMessage("Deleted dir: ".'../submissaoSip/upload/'.getCodEnunciado($codProj).'/'.$codProj);
        }else{
          echo "Path not found!";
        }

    }

    function logMessage($message)
    {
        echo "<script>console.log('LOG: ".$message."');</script>";
    }
?>
