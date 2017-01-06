<?php

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
$profs=array();

//$listaNomes=$profs->xpath("//professor/nome");

$query = $bd->query("SELECT * FROM professor");
    while ($linha = $query->fetch()){
        echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($profs, $linha);
        }
$rstring ="<option>Escolher Professor</option>";

//usort($listaNomes, 'cmp');

foreach($profs as $p)
{
$rstring .= "<option value='".(string)$p['codProf']."'>".trim((string)$p['nome'])."</option>";
}

echo $rstring;

echo "<pre>";
print_r($profs);
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