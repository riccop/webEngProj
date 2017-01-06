<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codEnunciado=$_REQUEST['enunciado']; 
$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
$descricao="";

while ($linha = $query->fetch()){
        $descricao=$linha['descricao'];
        }

echo "<h1>Submissão de SIPs - ".(string)$descricao."</h1>
        <form method='get' action='formulario-projectrecord-dynamic.php'>
            <input type='hidden' name='enunciado' id='enunciado' value='".$codEnunciado."'/>
            <input type='submit' value= 'Submeter Project Record através de formulário'/>
        </form>
         <form method='get' action='formulario-ficheiro.php'>
            <input type='hidden' name='enunciado' id='enunciado' value='".$codEnunciado."'/>
            <input type='submit' value='Submeter Project Record através dum ficheiro ZIP'/>
        </form>
        ";
        
?>