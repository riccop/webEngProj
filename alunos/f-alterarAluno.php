<?php
/*
if($_RESQUEST['curso']=="" || $_RESQUEST['curso']=="Escolher curso" || $_RESQUEST['discLista']=="Escolher disciplina"){
header( "Location:consultarDiscs.html" );
}
*/
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['aluno'];
}
if($form=="f2"){
$codigo=$_REQUEST['alunoLista'];
}
//$discs = simplexml_load_file("disciplinas.xml");
//$disc = $discs->xpath("//disciplina[codigo='".$codigo."']");

$query = $bd->query("SELECT * FROM aluno WHERE codAluno='".$codigo."'");
$codAluno="";
$nome="";
$email="";

 while ($linha = $query->fetch()){
                $codAluno=$linha['codAluno'];
                $nome=$linha['nome'];
                $email=$linha['email'];
                
        }
echo "<!DOCTYPE html>
<html>
    <head>
        <title>Alterar alunos</title>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
        <script src='verificaForm.js'></script>
        <meta charset='UTF-8'/>
    </head>
    <body>
        <h3 align='center'>
            Alterar Aluno ".(string)$nome."
        </h3>
        <form action='alterarAluno-pagPrincipal.php' method='get' onsubmit='return verificarCamposVazios();'>
         <input type='hidden' name='codigoAnterior' value='".(string)$codAluno."' id='codigoAnterior'/>
            <table>
                <tr>
                    <td>Código</td>
                    <td><input type='text' size='10' name='codigo' value='".(string)$codAluno."'/></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' size='60' name='nome' value='".(string)$nome."'/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type='text' size='50' name='email' value='".(string)$email."'/></td>
                </tr>
            </table>
            <input type='submit' value='Alterar'/>
        </form>
        <br/>
         <address><a href='pagPrincipalAlunos.html'/>Voltar ao início</address>
        <hr width='80%' align='center'/>
        <address>EngWeb2015 - projeto final</address>
    </body>
</html>";



//debug($_REQUEST);


//------------------------------------
/* Função para ordenar os elementos da lista de forma alfabética
*/
function cmp($a,$b)
{
return ((string)$a <= (string)$b)?-1:1;
}
function debug($my_data)
{
echo "<pre>";
print_r($my_data);
echo "</pre>";
}
?>