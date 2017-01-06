//executada quando pagina acaba de carregar
$(function () {
    $("#curso").load("getCursos.php");
    $("#discLista").load("getDiscLista.php");
    $("#enviar").click(function () {
        //fazer o submit através de um botao normal
           if ($("#curso").val() == "Escolher curso") {
            alert("Selecione o curso");
        } else {
            $("#myform").submit();
        }
       // $("#myform").submit();
    });
    $("#enviar2").click(function () {
        //fazer o submit através de um botao normal
        console.log("Aqui vai1 :" + $("#discLista").val());
        console.log("Aqui vai2 :" + "Escolher disciplina");
        
        if ($("#discLista").val() == "Escolher disciplina") {
            alert("Selecione o disciplina");
        } else {
            $("#myform2").submit();
        }
    });
});

function loadDiscs() {
    $("#disc").load("getDisciplinasCurso.php?d=" + encodeURIComponent($("#curso").val()));
}