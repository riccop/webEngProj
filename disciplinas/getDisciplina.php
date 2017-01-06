<?php
/*
if($_RESQUEST['curso']=="" || $_RESQUEST['curso']=="Escolher curso" || $_RESQUEST['profLista']=="Escolher disciplina"){
header( "Location:consultarProfs.html" );
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

//debug($prof);
$query = $bd->query("SELECT * FROM disciplina WHERE codUC='".$codigo."'");
$codigoProf="";
$designacao="";
$curso="";
$ano="";
        while ($linha = $query->fetch()){
                $codigoProf=$linha['codigoProf'];
                $designacao=$linha['designacao'];
                $curso=$linha['curso'];
                $ano=$linha['ano'];
        }

echo"<html>
    <head>
        <title>Disciplina</title>
        <meta charset='UTF-8'/>";
echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
echo"</head>
    <body>
        <h3 align='center'>
            Página da Disciplina ".(string)$designacao."
        </h3>
        <h2>Informações do disciplina</h2>
        <table border='1'>
            <tr>
                <th>Código</th>
                <th>Designação</th> 
                <th>Curso</th>
                <th>Ano</th>
                <th>Codigo Professor</th>
            </tr>
            <tr>
                <td>".(string)$codigoProf."</td>
                <td>".(string)$designacao."</td>
                <td>".(string)$curso."</td>
                <td>".(string)$ano."</td>
                <td>".(string)$codProf."</td>
            </tr>
        </table>
        <address><a href='pagPrincipalDiscs.html'/>Voltar ao início</address>
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