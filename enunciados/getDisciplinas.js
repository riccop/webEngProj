//executada quando pagina acaba de carregar
$(function () {
    $("#disciplina").load("getDisciplinas.php");
    $("#enviar").click(function () {
        //fazer o submit através de um botao normal
           if ($("#disciplina").val() == "Escolher disciplina") {
            alert("Selecione a disciplina");
        } else {
            $("#myform").submit();
        }
    });

});

function loadEnunciados() {
    $("#enunciado").load("getEnunciadosDisciplina.php?d=" + encodeURIComponent($("#disciplina").val()));
}
