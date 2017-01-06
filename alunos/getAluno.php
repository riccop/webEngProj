<?php
/*
if($_RESQUEST['curso']=="" || $_RESQUEST['curso']=="Escolher curso" || $_RESQUEST['profLista']=="Escolher disciplina"){
header( "Location:consultarProfs.html" );
}
*/

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
$form=$_REQUEST['form'];
if($form=="f1"){
$codigo=$_REQUEST['aluno'];
}
if($form=="f2"){
$codigo=$_REQUEST['alunoLista'];
}

//debug($prof);
$query = $bd->query("SELECT * FROM aluno WHERE codAluno='".$codigo."'");
$codAluno="";
$nome="";
$email="";

        while ($linha = $query->fetch()){
                $codAluno=$linha['codAluno'];
                $nome=$linha['nome'];
                $email=$linha['email'];
        }

echo"<html>
    <head>
        <title>Aluno</title>
        <meta charset='UTF-8'/>";
    echo '<link rel="stylesheet" type="text/css" href="mystyles.css">';
    echo "
    </head>
    <body>
        <h3 align='center'>
            Página do Aluno ".(string)$nome."
        </h3>
        <h2>Informações do aluno</h2>
        <table>
            <tr>
                <th>Código</th>
                <th>Nome</th> 
                <th>Email</th>
            </tr>
            <tr>
                <td>".(string)$codAluno."</td>
                <td>".(string)$nome."</td>
                <td>".(string)$email."</td>
            </tr>
        </table>
        <address><a href='pagPrincipalAlunos.html'/>Voltar ao início</address>
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