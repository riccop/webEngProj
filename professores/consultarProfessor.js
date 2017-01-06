//executada quando pagina acaba de carregar
$(function () {
    $("#departamento").load("getDepartamentos.php");
    $("#profLista").load("getProfLista.php");
    $("#enviar").click(function () {
        //fazer o submit através de um botao normal
           if ($("#departamento").val() == "Escolher departamento") {
            alert("Selecione o departamento");
        } else {
            $("#myform").submit();
        }
       // $("#myform").submit();
    });
    $("#enviar2").click(function () {
        //fazer o submit através de um botao normal
        console.log("Aqui vai1 :" + $("#profLista").val());
        console.log("Aqui vai2 :" + "Escolher professor");
        
        if ($("#profLista").val() == "Escolher professor") {
            alert("Selecione o professor");
        } else {
            $("#myform2").submit();
        }
    });
});

function loadProfs() {
    $("#prof").load("getProfessoresDepartamento.php?d=" + encodeURIComponent($("#departamento").val()));
}