<?php

$b=$_REQUEST['d'];
    $rstring = "Nº de submissões Total:";
    if (($b) == 'Escolher enunciado') {
    echo "sou enunciado";
            alert('Selecione o enunciado');
        } else {
            	$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');
                $query = $bd->query("SELECT * FROM projeto_submissao PS WHERE PS.codEnunciado='".$b."'");
                $rstring .=numeroDeLinhas($query)." e este ano:";
                $ano=date('Y');
                $query = $bd->query("SELECT * FROM projeto_submissao PS, enunciado E, disciplina D WHERE PS.codEnunciado='".$b."' and PS.codEnunciado=E.codEnunciado and E.codUC=D.codUC and D.ano='".$ano."'");
                $rstring .=numeroDeLinhas($query);
                echo $rstring;
 }
 
 function numeroDeLinhas($a)
{
    if($a==null || $a==false)
    {
        return 0;
    }
    else
    {
    $i=0;
    while ($linha = $a->fetch()){
        $i++;
    }
    
return $i;
}
}

 ?>