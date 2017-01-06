<?php

/*
AQUI
DEPOIS FAZER AS VERIFICAÇOES PARA GARANTIR QUE O FORMULARIO É TODO PREENCHIDO E NÃO HÁ FICHEIROS VAZIOS???
 IMPORTA É GARANTIR O ENVIO DE TUDO DIREITO
*/

$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

$codEnunciado=$_REQUEST['enunciado'];
$query = $bd->query("SELECT * FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
$descricao="";

$prof=getSupervisorData($codEnunciado);
$supervisorName=$prof[0];
$supervisorEmail=$prof[1];
$supervisorDepartment=$prof[2];

while ($linha = $query->fetch()){
        $descricao=$linha['descricao'];
        }
echo "<html>
    <head>
        <title>Project Record</title>
        <meta charset='UTF-8'/>
        <link rel='stylesheet' type='text/css' href='mystyles.css'>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
        <script src='projectrecord-dynamic.js'></script>
        <script src='verificaFormSubmissaoSIP.js'></script>
    </head>
    <body>
        <h2>Project Record Form ".$descricao."</h2>
        <form action='projectrecord-dynamic.php' method='post' enctype='multipart/form-data' onsubmit='return verificarCamposVazios();' >
        <input type='hidden' name='enunciado' id='enunciado' value='".$codEnunciado."'/>
        <fieldset>
            <legend>Meta data</legend>
         <table>
             <tr>
                 <td><label for='keyname'>Keyname:</label></td>
                 <td><input type='text' size='50' name='keyname' id='keyname'/></td>
            </tr>
        <tr>
            <td><label for='title'>Title:</label></td>
            <td><input type='text' size='50' name='title' id='title'/></td>
        </tr>
             <tr>
                 <td><label for='subtitle'>Subtitle:</label></td>
                 <td><input type='text' size='50' name='subtitle' id='subtitle'/></td>

             </tr>
             <tr>
                 <td><label for='begindate'>Begin Date:</label></td>
                 <td><input type='text' size='50' name='begindate' id='begindate'/></td>
             </tr>
             <tr>
                 <td><label for='enddate'>End Date:</label></td>
                 <td><input type='text' size='50' name='enddate' id='enddate'/></td>
             </tr>
         </table>
        <fieldset>
            <legend>Supervisor</legend>
            <table>
                <tr>
                    <td><label for='supervisorName'>Name:</label></td>
                    <td><input type='text' size='50' name='supervisorName' id='supervisorName' value='".$supervisorName."' disabled/></td>
                </tr>
                <tr>
                    <td><label for='supervisorEmail'>Email:</label></td>
                    <td><input type='text' size='50' name='supervisorEmail' id='supervisorEmail' value='".$supervisorEmail."' disabled/></td>
                </tr>
                <tr>
                    <td><label for='supervisorDepartment'>Department:</label></td>
                    <td><input type='text' size='50' name='supervisorDepartment' id='supervisorDepartment' value='".$supervisorDepartment."' disabled/></td>
                </tr>
            </table>
        </fieldset>
        </fieldset>
        <fieldset>
            <legend>Workteam</legend>
            <div id='membros'>
                <div id='membro0'>
                    <table id='table0'>
                        <tr>
                            <td><label for='memberName0'>Name:</label></td>
                            <td><input type='text' size='50' name='memberName[0]' id='memberName0'/></td>
                        </tr>
                        <tr>
                            <td><label for='memberIdentifier0'>Identifier:</label></td>
                            <td> <input type='text' size='50' name='memberIdentifier[0]' id='memberIdentifier0'/></td>
                        </tr>
                        <tr>
                            <td><label for='memberEmail0'>Email:</label></td>
                            <td><input type='text' size='50' name='memberEmail[0]' id='memberEmail0'/></td>
                        </tr>
                    </table>
                    <br/>
                    <br/>
                </div>

            </div>
            <div style='margin:7px;'>
                <button type='button' id='adicionarTeamMember' >Add</button>
                <button type='button' id='removerTeamMember'>Remove</button>
            </div>
        </fieldset>
        <fieldset>
            <legend>Abstract</legend>
            <textarea name='abstract' id='abstract' cols='100' rows='6'>Enter text here... You can use HTML with p, b and i </textarea>
        </fieldset>
        <fieldset>
            <legend>Deliverables</legend>
            <div id='ficheiros'>
             <div id='ficheiro0'>
                <label for='fich0'>File 1: </label>
                <input type='file' name='fich[0]' id='fich0'/>
                <br/>
                <br/>
             </div>

            </div>
            <br/>
            <div style='margin:7px;'>
                <button type='button' id='adicionarFicheiro' >Add</button>
                <button type='button' id='removerFicheiro'>Remove</button>
            </div>
        </fieldset>

            <br/>
            <input type='submit' value='Submit'/>
            <input type='reset' value='Clean'/>
        </form>
    </body>
</html>";


function getSupervisorData($codEnunciado){
$bd = new PDO('mysql:host=localhost;dbname=projetofinal', 'admin', '1234');

    $query = $bd->query("SELECT codUC FROM enunciado WHERE codEnunciado='".$codEnunciado."'");
     while ($linha = $query->fetch()){
         $codUC=$linha['codUC'];
        }
     $query = $bd->query("SELECT codProf FROM disciplina WHERE codUC='".$codUC."'");
     while ($linha = $query->fetch()){
         $codProf=$linha['codProf'];
        }
    $prof=array();
    $query = $bd->query("SELECT * FROM professor WHERE codProf='".$codProf."'");
     while ($linha = $query->fetch()){
         array_push($prof, $linha['nome']);
         array_push($prof, $linha['email']);
         array_push($prof, $linha['departamento']);
        }
    return $prof;
}

?>
