
$(function()
    {
        var cont=0;
        var contTM=0;
        var contNovo=0;
        var first=true;
        var workteamSize=0;
        //Aparece o input para adicionar um novo ficheiro quando se clica em "adicionar"
       $("#adicionarFicheiro").click(function(){
           cont++;
           $("#ficheiros").append("<div id='ficheiro"+cont+"'></div>");
           $("#ficheiro"+cont).append("<label for='fich"+cont+"'>File "+(cont+1)+": </label>");
          // <input type="file" name="fich[0]" id="fich0"/> 
          //<label for="fich0">File: </label>
           $("#ficheiro"+cont).append("<input type='file' name='fich["+cont+"]' id='fich"+cont+"'/>");
           $("#ficheiro"+cont).append("</br>");
           $("#ficheiro"+cont).append("</br>");

       });
       //É removido o input de um ficheiro quando se clica no botao "remover"
       $("#removerFicheiro").click(function(){
           if(cont>=0){
               $("#ficheiro"+cont).remove();
               cont--;               
           }
           else{
               alert("Atention: 0 files");
           }  
       });
      //É possível adicionar até 5 elementos de uma equipa
       $("#adicionarTeamMember").click(function(){
          if(first){
            contTM=$("#countTM").val()-1;
            workteamSize=$("#countTM").val();

            first=false;
          }
          console.log(workteamSize);
           if(contTM<4){
               contTM++;
               contNovo++;
               $("#membros").append("<div id='membro"+contTM+"'></div>");
               $("#membro"+contTM).append("<table id='table"+contTM+"'><input type='hidden' name='newMember' id='newMember' value='true'/></table>"); //é necessário declarar a tabela dentro da div com id="membroX"
               //são adicionadas as 3 linhas à tabela, que apresentam os inputs para NOME, IDENTIFICADOR e EMAIL
               $("#table"+contTM).append("<tr><td><label for='memberName"+contTM+"'>Name:</label></td><td><input type='text' size='50' name='memberName["+contTM+"]' id='memberName"+contTM+"'/></td></tr>");
               $("#table"+contTM).append("<tr><td><label for='memberIdentifier"+contTM+"'>Identifier:</label></td><td><input type='text' size='50' name='memberIdentifier["+contTM+"]' id='memberIdentifier"+contTM+"'/></td></tr>");
               $("#table"+contTM).append("<tr><td><label for='memberEmail"+contTM+"'>Email:</label></td><td><input type='text' size='50' name='memberEmail["+contTM+"]' id='memberEmail"+contTM+"'/></td></tr>");
                $("#membro"+contTM).append("</br>");
                $("#membro"+contTM).append("</br>");
           }
           else{
               alert("Atention: Max number of 5 elements per team.");
           }  
       });
       //é possível remover os elementos de uma equipa até 1 elemento, que é o valor mínimo
       $("#removerTeamMember").click(function(){
        
        if(first){
            contTM=$("#countTM").val()-1;
            workteamSize=$("#countTM").val();
            first=false;
          }
          console.log("Conta="+(((contTM+1)-workteamSize)));
           if((((contTM+1)-workteamSize)>0) ){
            
               $("#membro"+contTM).remove();
               contTM--;
               contNovo--;
           }
           else{
               alert("Atenção: Não se podem remover elementos da Workteam!");
           }
       });
    });