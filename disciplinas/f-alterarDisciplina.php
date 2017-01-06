<?php
/*
if($_RESQUEST['curso']=="" || $_RESQUEST['curso']=="Escolher curso" || $_RESQUEST['discLista']=="Escolher disciplina"){
header( "Location:consultarDiscs.html" );
}
*/
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['disc'];
}
if($form=="f2"){
$codigo=$_REQUEST['discLista'];
}
//$discs = simplexml_load_file("disciplinas.xml");
//$disc = $discs->xpath("//disciplina[codigo='".$codigo."']");

$query = $bd->query("SELECT * FROM disciplina WHERE codUC='".$codigo."'");
$codUC="";
$designacao="";
$curso="";
$ano="";
 while ($linha = $query->fetch()){
                $codUC=$linha['codUC'];
                $designacao=$linha['designacao'];
                $curso=$linha['curso'];
                $ano=$linha['ano'];
        }
echo "<!DOCTYPE html>
<html>
    <head>
        <title>Alterar disciplina</title>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
        <script src='verificaForm.js'></script>";
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
        echo "
        <meta charset='UTF-8'/>
    </head>
    <body>
        <h3 align='center'>
            Alterar disciplina ".(string)$designacao."
        </h3>
        <form action='alterarDisc-pagPrincipal.php' method='get' onsubmit='return verificarCamposVazios();'>
         <input type='hidden' name='codigoAnterior' value='".(string)$codUC."' id='codigoAnterior'/>
            <table>
                <tr>
                    <td>Código</td>
                    <td><input type='text' size='10' name='codigo' value='".(string)$codUC."'/></td>
                </tr>
                <tr>
                    <td>Designacao</td>
                    <td><input type='text' size='60' name='designacao' value='".(string)$designacao."'/></td>
                </tr>
                <tr>
                    <td>Curso</td>
                    <td><input type='text' size='20' name='curso' value='".(string)$curso."'/></td>
                </tr>
                 <tr>
                    <td>Ano</td>
                    <td><input type='text' size='40' name='ano' value='".(string)$ano."'/></td>
                </tr>
            </table>
            <input type='submit' value='Alterar'/>
        </form>
        <br/>
         <address><a href='pagPrincipalDiscs.html'/>Voltar ao início</address>
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