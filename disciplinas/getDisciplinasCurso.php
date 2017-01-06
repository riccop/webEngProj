<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
//$disciplinas = simplexml_load_file("professores.xml");
$curso=$_REQUEST['d'];
$disciplinas=array();  
$rstring="";
    
$query = $bd->query("SELECT * FROM disciplina WHERE curso='".$curso."'");
    while ($linha = $query->fetch()){
        $disc['codUC']=$linha['codUC'];
        $disc['designacao']=$linha['designacao'];
        $disc['curso']=$linha['curso'];
        $disc['ano']=$linha['ano'];
        $disc['codProf']=$linha['codProf'];
        array_push($disciplinas, $disc);
        }

//usort($lista, 'cmp');

foreach($disciplinas as $d)
{
$rstring .= "<option value='".(string)$d['codUC']."'>".trim((string)$d['designacao'])."</option>";
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