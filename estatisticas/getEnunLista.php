<?php

    $bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
    $enun=array();

//$listaNomes=$profs->xpath("//professor/nome");

    $query = $bd->query("SELECT * FROM enunciado");
    while ($linha = $query->fetch()){
        //echo $linha;
       // $prof['codigoProf']=$linha['codigoProf'];
       // $prof['nome']=$linha['nome'];
       // $prof['departamento']=$linha['departamento'];
       // $prof['email']=$linha['email'];
        array_push($enun, $linha);
        }
    $rstring ="<option>Escolher enunciado</option>";

//usort($listaNomes, 'cmp');

    foreach($enun as $e)
    {
        $rstring .= "<option value='".(string)$e['codEnunciado']."'>".trim((string)$e['codUC']."-".(string)$e['codEnunciado'])."</option>";
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