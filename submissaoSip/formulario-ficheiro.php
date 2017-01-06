<?php
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codEnunciado=$_REQUEST['enunciado'];
$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
$descricao="";

while ($linha = $query->fetch()){
        $descricao=$linha['descricao'];
        }

echo "
<html>
    <head>
        <link rel='stylesheet' type='text/css' href='mystyles.css'>
        <title>Submissão de SIP</title>
    </head>
    <body>
        <h3>Submissão de 1 ficheiro ZIP - ".$descricao."</h3>
        <!-- ALTERAR o action quando se pretende testar outro ficheiro php -->
        <form action='processaSIPzip.php' method='post' enctype='multipart/form-data'>
            <label for='ficheiro'>Ficheiro: </label>
            <input type='file' name='ficheiro' id='ficheiro'/>
            <input type='hidden' name='enunciado' id='enunciado' value='".$codEnunciado."'/>
            <input type='submit' value='Enviar'/>
        </form>
    </body>
</html>";

?>
