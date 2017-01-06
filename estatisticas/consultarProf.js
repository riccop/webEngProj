//executada quando pagina acaba de carregar
$(function () {
    $("#profLista").load("getListaProfs.php");
    $("#enviar2").click(function () {
        //fazer o submit através de um botao normal
        console.log("Aqui vai1 :" + $("#profLista").val());
        console.log("Aqui vai2 :" + "Escolher aluno");
        
        if ($("#profLista").val() == "Escolher aluno") {
            alert("Selecione o aluno");
        } else {
            $("#myform2").submit();
        }
    });
});
