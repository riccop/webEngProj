<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
//$professores = simplexml_load_file("professores.xml");
$disciplina=$_REQUEST['d'];
$enunciados=array();  
$rstring="";
    
$query = $bd->query("SELECT * FROM enunciado WHERE codUC='".$disciplina."'");
    while ($linha = $query->fetch()){
        $enunc['codEnunciado']=$linha['codEnunciado'];
        $enunc['codUC']=$linha['codUC'];
        $enunc['dataInicio']=$linha['dataInicio'];
        $enunc['dataFim']=$linha['dataFim'];
        $enunc['descricao']=$linha['descricao'];
        array_push($enunciados, $enunc);
        }

//usort($lista, 'cmp');

foreach($enunciados as $enunc)
{
$rstring .= "<option value='".(string)$enunc['codEnunciado']."'>".trim((string)$enunc['descricao'])."</option>";
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