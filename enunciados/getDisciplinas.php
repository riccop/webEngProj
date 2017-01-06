<?php

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');



$lista=array();

$query = $bd->query("SELECT DISTINCT * FROM disciplina");
   
        while ($linha = $query->fetch()){
            $disc['codUC']=$linha['codUC'];
            $disc['designacao']=$linha['designacao'];
           array_push($lista, $disc);
        }

$rstring ="<option>Escolher disciplina</option>";

usort($lista, 'cmp');

foreach($lista as $v)
{
$rstring .= "<option value='".(string)$v['codUC']."'>".trim((string)$v['designacao'])."</option>";
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