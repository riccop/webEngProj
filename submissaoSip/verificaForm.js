function verificarCamposVazios()
{
  console.log("Valor Form");
    var camposVazios=false;
    var asd = document.forms[0];
    //alert("ha " + asd.elements.length + "elementos");
    for(var i=0;i<asd.elements.length-1;i++)
    {

      console.log("Valor Form"+i+" = "+asd.elements[i].value);
      console.log("Valor Form"+i+" = "+asd.elements[i].id);
        if(asd.elements[i].value=="")
        {camposVazios=true;}
    }
    //console.log(camposVazios);
    if(camposVazios==true)
    {
        alert("Existem campos vazios.");
        return false;
    }
    else
    {
    //return true;
        return true;
    }

}
