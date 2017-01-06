//executada quando pagina acaba de carregar
$(function () {
    $("#aluno").load("getListaAlunos.php");
    $("#enviar2").click(function () {
        //fazer o submit através de um botao normal
        console.log("Aqui vai1 :" + $("#aluno").val());
        console.log("Aqui vai2 :" + "Escolher aluno");
        
        if ($("#aluno").val() == "Escolher Aluno") {
            alert("Selecione o aluno que fez a submissão.");
        } else {
            $("#myform2").submit();
        }
    });



});
