//executada quando pagina acaba de carregar
$(function () {
    $("#alunoLista").load("getAlunoLista.php");
    $("#enviar2").click(function () {
        //fazer o submit através de um botao normal
        console.log("Aqui vai1 :" + $("#alunoLista").val());
        console.log("Aqui vai2 :" + "Escolher aluno");
        
        if ($("#discLista").val() == "Escolher aluno") {
            alert("Selecione o aluno");
        } else {
            $("#myform2").submit();
        }
    });
});
