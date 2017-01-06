<?php

$profs = simplexml_load_file("professores.xml");

$lista = $profs->xpath("//professor");
//$listaNomes=$profs->xpath("//professor/nome");
$rstring ="<option>Escolher professor</option>";

//usort($listaNomes, 'cmp');

foreach($lista as $p)
{
$rstring .= "<option value='".(string)$p->codigo."'>".trim((string)$p->nome)."</option>";
}

echo $rstring;

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