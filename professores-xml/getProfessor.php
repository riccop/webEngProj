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


echo"<html>
    <head>
        <title>Professor</title>
    </head>
    <body>
        <h3 align='center'>
            Página do Professor ".(string)$prof[0]->nome."
        </h3>
        <h2>Informações do professor</h2>
        <table border='1'>
            <tr>
                <th>Código</th>
                <th>Nome</th> 
                <th>Departamento</th>
            </tr>
            <tr>
                <td>".(string)$prof[0]->codigo."</td>
                <td>".(string)$prof[0]->nome."</td>
                <td>".(string)$prof[0]->departamento."</td>
            </tr>
        </table>
        <address><a href='index.html'/>Voltar ao início</address>
        <hr width='80%' align='center'/>
        <address align='center'>EngWeb2015 - projeto final</address>
    </body>
</html>";


debug($_REQUEST);


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