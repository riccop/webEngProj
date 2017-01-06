function verificarCamposVazios()
{
    var camposVazios=false;
    var asd = document.forms[0];
    //alert("ha " + asd.elements.length + "elementos");
    for(var i=0;i<asd.elements.length-1;i++)
    {
        if(asd.elements[i].value=="")
        {camposVazios=true;}
    }
    //console.log(camposVazios);
    if(camposVazios==true)
    {
        alert("Existem campos vazios");
        return false;
    }
    else
    {
    return true;
    }
}

