<?php
/*
if($_RESQUEST['departamento']=="" || $_RESQUEST['departamento']=="Escolher departamento" || $_RESQUEST['profLista']=="Escolher professor"){
header( "Location:consultarProfs.html" );
}
*/
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['prof'];
}
if($form=="f2"){
$codigo=$_REQUEST['profLista'];
}
//$profs = simplexml_load_file("professores.xml");
//$prof = $profs->xpath("//professor[codigo='".$codigo."']");

$query = $bd->query("SELECT * FROM Professor WHERE codProf='".$codigo."'");
$codigoProf="";
$nome="";
$departamento="";
$email="";
 while ($linha = $query->fetch()){
                $codigoProf=$linha['codProf'];
                $nome=$linha['nome'];
                $departamento=$linha['departamento'];
                $email=$linha['email'];
        }
echo "<!DOCTYPE html>
<html>
    <head>
        <title>Alterar professor</title>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
        <script src='verificaForm.js'></script>
        <meta charset='UTF-8'/>";
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    echo "</head>
    <body>
        <h3 align='center'>
            Alterar professor ".(string)$nome."
        </h3>
        <form action='alterarProf-pagPrincipal.php' method='get' onsubmit='return verificarCamposVazios();'>
         <input type='hidden' name='codigoAnterior' value='".(string)$codigoProf."' id='codigoAnterior'/>
            <table>
                <tr>
                    <td>Código</td>
                    <td><input type='text' size='10' name='codigo' value='".(string)$codigoProf."'/></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' size='60' name='nome' value='".(string)$nome."'/></td>
                </tr>
                <tr>
                    <td>Departamento</td>
                    <td><input type='text' size='20' name='departamento' value='".(string)$departamento."'/></td>
                </tr>
                 <tr>
                    <td>Email</td>
                    <td><input type='text' size='40' name='email' value='".(string)$email."'/></td>
                </tr>
            </table>
            <input type='submit' value='Alterar'/>
        </form>
        <br/>
         <address><a href='pagPrincipalProfs.html'/>Voltar ao início</address>
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
