<?php
/*
if($_RESQUEST['departamento']=="" || $_RESQUEST['departamento']=="Escolher departamento" || $_RESQUEST['profLista']=="Escolher professor"){
header( "Location:consultarProfs.html" );
}
*/
$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['prof'];
}
if($form=="f2"){
$codigo=$_REQUEST['profLista'];
}
$profs = simplexml_load_file("professores.xml");
$prof = $profs->xpath("//professor[codigo='".$codigo."']");

//debug($prof);

echo "<!DOCTYPE html>
<html>
    <head>
        <title>Alterar professor</title>
    </head>
    <body>
        <h3 align='center'>
            Alterar professor ".(string)$prof[0]->nome."
        </h3>
        <form action='alterarProf.php' method='get'>
         <input type='hidden' name='codigoAnterior' value='".(string)$prof[0]->codigo."' id='codigoAnterior'/>
            <table>
                <tr>
                    <td>Código</td>
                    <td><input type='text' size='15' name='codigo' value='".(string)$prof[0]->codigo."'/></td>
                </tr>
                <tr>
                    <td>Nome</td>
                    <td><input type='text' size='15' name='nome' value='".(string)$prof[0]->nome."'/></td>
                </tr>
                <tr>
                    <td>Departamento</td>
                    <td><input type='text' size='15' name='departamento' value='".(string)$prof[0]->departamento."'/></td>
                </tr>
            </table>
            <input type='submit' value='Alterar'/>
        </form>
        <br/>
         <address><a href='index.html'/>Voltar ao início</address>
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