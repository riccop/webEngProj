<?php

    $professores = simplexml_load_file("professores.xml");
    $departamento=$_REQUEST['d'];
    $profs = $professores->xpath("//professor[normalize-space(./departamento)='".$departamento."']");
    
    $rstring="";


usort($lista, 'cmp');

foreach($profs as $p)
{
$rstring .= "<option value='".(string)$p->codigo."'>".trim((string)$p->nome)."</option>";
}

echo $rstring;

debug($profs);

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