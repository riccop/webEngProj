function verificarCamposVazios()
{
    var camposVazios=false;
    var asd = document.forms[0];
    var dataini = asd.elements[1].value;
    var datafim = asd.elements[2].value;
    console.log("data Ini: "+dataini);
    //alert("ha " + asd.elements.length + "elementos");
    for(var i=0;i<asd.elements.length-1;i++)
    {
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
        if(new Date(dataini)>new Date(datafim)){
          alert("A data de inicio tem que ser inferior à data de fim.");
          return false;
        }
        else{return true;}
    }

}
