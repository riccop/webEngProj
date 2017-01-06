<?php
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    if($_REQUEST['resposta'])
    {
      $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

      $query = $bd->query("DELETE FROM projeto_aluno");
      //apagar ficheiros da diretoria
      removeAllFiles();
      $query = $bd->query("DELETE FROM ficheiro");
      $query = $bd->query("DELETE FROM projeto_submissao");
	   echo "<p>Informação removida. <a href='pagPrincipalSips.html'>Voltar ao inicio</a></p>";
    }
    else
    {
        echo "<p>Remoção cancelada. <a href='pagPrincipalSips.html'>Voltar ao inicio</a></p>";
    }

    function removeAllFiles(){
      rrmdir('../submissaoSip/upload/');
    }

    function rrmdir($dir) {
if (is_dir($dir)) {
  $objects = scandir($dir);
  foreach ($objects as $object) {
    if ($object != "." && $object != "..") {
      if (filetype($dir."/".$object) == "dir")
         rrmdir($dir."/".$object);
      else unlink   ($dir."/".$object);
    }
  }
  reset($objects);
  if($dir!="../submissaoSip/upload/"){
  rmdir($dir);
  }
}
}

?>
