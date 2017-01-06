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

//debug($prof);
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

echo"<html>
    <head>
        <title>Professor</title>
        <meta charset='UTF-8'/>";
 echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    echo" </head>
    <body>
        <h3 align='center'>
            Página do Professor ".(string)$nome."
        </h3>
        <h2>Informações do professor</h2>
        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th> 
                <th>Departamento</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>".(string)$codigoProf."</td>
                <td>".(string)$nome."</td>
                <td>".(string)$departamento."</td>
                <td>".(string)$email."</td>
            </tr>
        </table>
        <address><a href='pagPrincipalProfs.html'/>Voltar ao início</address>
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