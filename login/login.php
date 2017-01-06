<?php
if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
  $codUser = $_REQUEST['username'];
  $chave = $_REQUEST['password'];
  if (checkUserLogin($codUser,$chave)){//se fez login
    //set dos cookies
    setcookie('username', $_REQUEST['username']);
    //ir página respetiva ao utilizador
    gotoUserPage($codUser);
    } else {
        echo "Correspondência entre código e chave inválida!";
        goInitPage();
    }
} else {
    echo "Campos vazios.";
    goInitPage();
}

//ALTERAR AQUI DIRETORIA PARA ONDE SE QUER REDIRECIONAR DEPOIS DO LOGIN
function gotoUserPage($codUser){
  /*se fez login então saber se é prof aluno ou admin e ir para a respetiva página*/
  if(startsWith($codUser, "A") ){
    //pagAluno.html
    header('Location: pagAluno.html');
  }
  if(startsWith($codUser, "P")){
    //pagProfessor.html
    header('Location: pagProfessor.html');
  }
  if(startsWith($codUser, "admin")){
    //pagAdmin.html
    header('Location: pagAdmin.html');
  }
}

function checkUserLogin($codUser,$chave){

  $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

  $chavebd = "";

    $query = $bd->query("SELECT password FROM utilizador WHERE utilizador.codUtilizador='".$codUser."'");
      while ($linha = $query->fetch()){
        $chavebd=$linha['password'];
      }
  //verificar se chave coincide com a do utilizador
  if ($chavebd==hash('sha256', $chave)){
     //echo "Password verified!";
     logMessage('Password verified!');
     return true;
  }else{
    return false;
  }
}

function goInitPage(){
  echo "</br>";
   echo "<a href='login.html'>Página inicial</a>";
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function logMessage($message)
{
    echo "<script>console.log('LOG: ".$message."');</script>";
}
?>
