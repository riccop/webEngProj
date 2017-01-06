$(function () {
    $("#enunLista").load("getEnunLista.php");
    $("#alunoLista").load("getListaAlunos.php");
    
}


);
function actualizar(asd){
    $("#submissoesPorEnunciado").load("atualizar.php?d=" + encodeURIComponent($("#enunLista").val()));

    //load("atualizar.php");
}
function actualizar2(asd){
    $("#submissoesPorAluno").load("atualizar2.php?d=" + encodeURIComponent($("#alunoLista").val()));

    //load("atualizar.php");
}
