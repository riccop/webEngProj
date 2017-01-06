function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}

function acessoAdmin() {
    var user = getCookie("username");
    if (user != "admin") {
        alert("Não pode aceder a esta pagina");
        window.history.back();
    } else {

    }
}
function acessoProf() {
    var user = getCookie("username");
    if (user != "admin" || user.charAt(0)=="P" || user.charAt(0)=="p") {
        alert("Não pode aceder a esta pagina");
        window.history.back();
    } else {

    }
}

function acessoAluno() {
    var user = getCookie("username");
    if (user != "admin" || user.charAt(0)=="P" || user.charAt(0)=="p" || user.charAt(0)=="A" || user.charAt(0)=="a") {
        alert("Não pode aceder a esta pagina");
        window.history.back();
    } else {

    }
}
function verificarUser() {
    var user = getCookie("username");
 
    if (user == "admin") {
    return "admin";
} 
    if (user.charAt(0)=="P" || user.charAt(0)=="p") {
            return "prof";
    }
    if (user.charAt(0)=="A" || user.charAt(0)=="a") {
            return "aluno";
    }
}
function logout()
{
    setCookie("username","",0);
    window.location.href = "localhost/engenhariaweb2015/projetofinal/index.html";
}
// JavaScript Document