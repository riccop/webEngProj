<?php
header('Content-Type: text/html; charset=UTF-8');

mb_internal_encoding('UTF-8'); 
mb_http_output('UTF-8'); 
mb_http_input('UTF-8'); 
mb_regex_encoding('UTF-8'); 
echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
      
      <title>Project Record</title><style>
                    body{background-color:#CCCCCC}
                </style></head>
   <body>
      ";
echo "<h1 align=\"center\">".$_REQUEST['keyname']."</h1><hr>";

echo "<h2 align=\"center\">".$_REQUEST['title']."</h2>";
echo "<h3 align=\"center\">".$_REQUEST['subtitle']."</h3>";
echo "<p align=\"center\" style=\"color:darkblue\"><b>".$_REQUEST['begindate']." - ".$_REQUEST['enddate']."</b></p>";
echo "<hr><hr>";
echo "<h3>Supervisor:</h3>";
echo"      <table border=\"1\" cellpadding=\"2px\">
         <tbody><tr>
           <th>Nome</th>
            <th>Email</th>
            <th>URL</th>
         </tr>";
echo "<tr><td>".$_REQUEST['supervisorName']."</td>";   
echo "<td><a href=\"mailto:".$_REQUEST['supervisorEmail']."\">".$_REQUEST['supervisorEmail']."</a></td>";
//ver o erro: porque é que não aparece o email direito na tabela?!
echo "<td><a href=\"".$_REQUEST['supervisorURL']."\">".$_REQUEST['supervisorURL']."</a></tr></table>"; 
 //fazer aqui com o url igual à linha de cima
 
echo "<hr><hr>";
echo "<h3>Work Team:</h3>";
echo"      <table border=\"1\" cellpadding=\"2px\">
         <tbody><tr>
           <th>Número</th>
            <th>Nome</th>
            <th>Email</th>
         </tr>";
echo "<tr><td>".$_REQUEST['memberIdentifier']."</td>";   
echo "<td>".$_REQUEST['memberName']."</td>";
echo "<td><a href=\"mailto:".$_REQUEST['memberEmail']."\">".$_REQUEST['memberEmail']."</a></td></tr></table>";      
echo "<hr><hr>";
echo "<h3>Abstract:</h3>";
echo $_REQUEST['abstract'];
echo "<hr><hr>";
echo "<h3>Deliverables:</h3>";
//<file path="site/index.html">site/index.html</file>
echo "<ol>";
//ciclo a percorrer os ficheiros
$ficheiro=$_FILES["ficheiro"];

for ($i = 0; $i < 4; $i++){
if($ficheiro["error"][$i]>0){
//  echo "<p>Erro a carregar ficheiro. Erro: ". $ficheiro["error"][$i]. "</p><br/>";
#imprime o valor do erro caso exista um erro
}
else
{
    if(file_exists("upload/". $ficheiro["name"][$i])){
    #a funcao file_exists  verifica a existencia do ficheiro
    echo "<li>Error: File already exists in server.</li>";
    }
    else{
        move_uploaded_file($ficheiro["tmp_name"][$i] , "upload/".$ficheiro["name"][$i]);
       //echo "<p>Ficheiro guardado em: "."upload/".$ficheiro["name"]."</p>";
       // echo"";
        echo "<li><a href=\""."upload/".$ficheiro["name"][$i]. "\">"."upload/".$ficheiro["name"][$i]."</a></li>";
    }
   }
}
echo "</ol>";
/*
echo "TESTES";
echo "<hr/>";
echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";
*/
echo "</body></html>";
?>