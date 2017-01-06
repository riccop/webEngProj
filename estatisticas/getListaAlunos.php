<?php

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
$alunos=array();

//$listaNomes=$profs->xpath("//professor/nome");

$query = $bd->query("SELECT * FROM aluno");
    while ($linha = $query->fetch()){
        echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($alunos, $linha);
        }
$rstring ="<option>Escolher Aluno</option>";

//usort($listaNomes, 'cmp');

foreach($alunos as $d)
{
$rstring .= "<option value='".(string)$d['codAluno']."'>".trim((string)$d['nome'])."</option>";
}

echo $rstring;

echo "<pre>";
print_r($alunos);
echo "</pre>";
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