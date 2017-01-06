<?php

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
$disciplinas=array();

//$listaNomes=$profs->xpath("//professor/nome");

$query = $bd->query("SELECT * FROM disciplina");
    while ($linha = $query->fetch()){
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($disciplinas, $linha);
        }
$rstring ="<option>Escolher Disciplina</option>";

//usort($listaNomes, 'cmp');

foreach($disciplinas as $d)
{
$rstring .= "<option value='".(string)$d['codUC']."'>".trim((string)$p['designacao'])."</option>";
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