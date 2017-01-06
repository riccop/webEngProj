<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
//$professores = simplexml_load_file("professores.xml");
$departamento=$_REQUEST['d'];
$professores=array();  
$rstring="";
    
$query = $bd->query("SELECT * FROM Professor WHERE departamento='".$departamento."'");
    while ($linha = $query->fetch()){
        $prof['codProf']=$linha['codProf'];
        $prof['nome']=$linha['nome'];
        $prof['departamento']=$linha['departamento'];
        $prof['email']=$linha['email'];
        array_push($professores, $prof);
        }

//usort($lista, 'cmp');

foreach($professores as $p)
{
$rstring .= "<option value='".(string)$p['codProf']."'>".trim((string)$p['nome'])."</option>";
}

echo $rstring;

//debug($profs);

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