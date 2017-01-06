<?php

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
//$profs = simplexml_load_file("professores.xml");

//$lista = $profs->xpath("//departamento[not(.=preceding::departamento)]");
$lista=array();
$query = $bd->query("SELECT DISTINCT departamento FROM Professor");
   
        while ($linha = $query->fetch()){
                array_push($lista, $linha['departamento']);
                //echo "DEPARTAMENTO= ". $linha['departamento']."\n";
        }

$rstring ="<option>Escolher departamento</option>";

usort($lista, 'cmp');

foreach($lista as $v)
{
$rstring .= "<option>".trim($v)."</option>";
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