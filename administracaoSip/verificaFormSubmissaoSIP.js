function verificarCamposVazios()
{
  console.log("Valor Form");
    var asd = document.forms[0];
    //alert("ha " + asd.elements.length + "elementos");
    for(var i=0;i<asd.elements.length-1;i++)
    {
      switch (asd.elements[i].id) {
        case "keyname":
          if(asd.elements[i].value=="")
          {
            alert("Campo keyname vazio.");
            return false;
          }
          break;
        case "title":
        if(asd.elements[i].value=="")
        {
          alert("Campo title vazio.");
          return false;
        }
          break;
        case "subtitle":
        if(asd.elements[i].value=="")
        {
          alert("Campo subtitle vazio.");
          return false;
        }
          break;
        case "begindate":
        if(asd.elements[i].value=="")
        {
          alert("Campo begindate vazio.");
          return false;
        }
          break;
        case "enddate":
          if(asd.elements[i].value=="")
          {
            alert("Campo enddate vazio.");
            return false;
          }
          break;
        case "abstract":
            if(asd.elements[i].value=="")
            {
              alert("Campo abstract vazio.");
              return false;
            }
          break;
      }


      console.log("VALUE: "+"memberName".indexOf(asd.elements[i].id));
      console.log("ID"+i+" "+asd.elements[i].id);
      console.log("Value"+i+" "+asd.elements[i].value);

      if(i+2<asd.elements.length-1 )
      if(asd.elements[i].id.indexOf("memberName")>-1 && asd.elements[i+1].id.indexOf("memberIdentifier")>-1 && asd.elements[i+2].id.indexOf("memberEmail")>-1)
      {
        if(asd.elements[i].value==""||asd.elements[i+1].value==""||asd.elements[i+2].value=="")
        {
          alert("Campo(s) Workteam vazio(s).");
          return false;
        }
      }

    }
    return true;
}
