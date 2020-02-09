<!DOCTYPE html>
<html>
<head>




<script type="text/javascript"> 
        
 function wijzig()
{
var ok = true;
if (document.getElementById("naam").value==""){
    document.getElementById("naamVerplicht").innerHTML="Gelieve een naam in te vullen";
    ok=false;
        }
    else{
        document.getElementById("naamVerplicht").innerHTML="";
    }

 if (document.getElementById("paswoord").value==""){
    document.getElementById("paswoordVerplicht").innerHTML="Gelieve een paswoord in te vullen";
    ok=false;
        }
    else{
        document.getElementById("paswoordVerplicht").innerHTML="";
    }
 
if (document.getElementById("paswoord").value != "") {
   var string=document.getElementById("paswoord").value;
    
	var filter=/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
   
     if ( filter.test(string)){
     document.getElementById("paswoordControle").innerHTML="";
        
        
    }
    else{
         document.getElementById("paswoordControle").innerHTML="Ongeldig paswoord, bevat minstens 1 cijfer en 1 hoofdletter en kleine letter, minimum 8 characters";
        ok=false;
        
    }
 }
 
 
  if (document.getElementById("paswoordConfirm").value==""){
    document.getElementById("paswoordConfirmVerplicht").innerHTML="Gelieve een bevestigingspaswoord in te vullen";
    ok=false;
        }
    else{
        document.getElementById("paswoordConfirmVerplicht").innerHTML="";
   
  if (!(document.getElementById("paswoordConfirm").value==document.getElementById("paswoord").value)){
    document.getElementById("paswoordConfirmVerplicht").innerHTML="bevestigingspaswoord en paswoord komen niet overeen";
    ok=false;
        }
    else{
        document.getElementById("paswoordConfirmVerplicht").innerHTML +="";
    }
	}

if (ok==true){
    document.inlogpagina.submit();
}
   
   
   
   
    
}
   

        

</script>

    
   
   <style type="text/css">
    .fout {
	color: #F00;
}
    </style>
</head>
<body>
 

<div class="hoofding">
<p>

 
inlogpagina:
</p>
</div>
<form name="inlogpagina" id="myForm" method="post" action="aangemeld.php">
<table cellspacing="4">
<tr>
<td><label for="naam">Naam:</label></td>
<td><input type="text" name="naam" id="naam"></td>
<td><label id="naamVerplicht" class="fout"></label></td>
</tr>
<tr>
<tr>
<td><label for="paswoord">paswoord:</label></td>
<td><input type="password" name="paswoord" id="paswoord"  ></td>
<td><label id="paswoordControle" class="fout"></label><label id="paswoordVerplicht" class="fout"></label></td>
</tr>
<tr>
<td><label for="paswoordConfirm">bevestiging paswoord:</label></td>
<td><input type="password" name="paswoordConfirm" id="paswoordConfirm"  ></td>
<td><label id="paswoordConfirmControle" class="fout"></label><label id="paswoordConfirmVerplicht" class="fout"></label></td>
</tr>
<tr>
<td></td>
<td>
<input type="button" value="inloggen" onclick="wijzig()" />
</td>
</tr>
</table>
</form>
</body>
</html>
