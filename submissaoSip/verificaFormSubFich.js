$(//função executada quando a pagina acaba de carregar
function () {
    $("#enviar").click(function () {
        if ($("#ficheiro").get(0).files.length == 0) {
            alert("Insira um ficheiro por favor!");
            console.log("No files selected.");
        } else {
            
            $.ajax({
                type:"get",
                url:"processaSIPzip.php",
                enctype:"multipart/form-data",
                data:"ficheiro=" + $("#ficheiro").v
            });

        }
    });
});