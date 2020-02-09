<!DOCTYPE html>
<html lang="en">
<head>
   

<script type="text/javascript"> 

    
    
    
function wijzig(){
    
var ok = true;
    
    //naam
if (document.getElementById("naam").value==""){
    document.getElementById("naamVerplicht").innerHTML="Gelieve een naam in te vullen";
    ok=false;
        }
    else{
        document.getElementById("naamVerplicht").innerHTML="";
    }

    //familienaam
    if (document.getElementById("familienaam").value==""){
    document.getElementById("familienaamVerplicht").innerHTML="Gelieve een familienaam in te vullen";
    ok=false;
        }
    else{
        document.getElementById("familienaamVerplicht").innerHTML="";
    }

    //paswoord
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
 
    //paswoord bevestigen
  if (document.getElementById("paswoordB").value==""){
    document.getElementById("paswoordBVerplicht").innerHTML="Gelieve een bevestigingspaswoord in te vullen";
    ok=false;
        }
    else{
        document.getElementById("paswoordBVerplicht").innerHTML="";
   
  if (!(document.getElementById("paswoordB").value==document.getElementById("paswoord").value)){
    document.getElementById("paswoordBControle").innerHTML="bevestigingspaswoord en paswoord komen niet overeen";
    ok=false;
        }
    else{
        document.getElementById("paswoordBControle").innerHTML +="";
    }
	}
    
    //email
 

    //gsm
    if (document.getElementById("gsm").value==""){
    document.getElementById("gsmVerplicht").innerHTML="Gelieve een gsmnummer in te vullen";
    ok=false;
        }
    else{
        document.getElementById("gsmVerplicht").innerHTML="";
    }

if (ok==true){

	
alert("start submit");

    document.aanmaken.submit();
    
}
    </script>
    
    
    
   

        




     <title>TEST</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">

     <!-- MAIN CSS -->    
     <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body>



                                                                             
                                        <!-- TAB PANES -->
                                        <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                                  <form name="aanmaken" action="test_invoegen.php" method="post">
                                                      <table cellspacing="4">
                                                          <tr>
                                                              <td>
                                                       <input type="text" class="form-control" id="naam" name="naam" placeholder="Naam*" required>
                                                              </td>
                                                              <td>
                                                              <label id="naamVerplicht"></label>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                       <input type="text" class="form-control" id="familienaam" name="familienaam" placeholder="Familienaam*" required>
                                                              </td>
                                                              <td>
                                                              <label id="familienaamVerplicht"></label>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                       <input type="email" class="form-control" id="email" name="email" placeholder="Email*" required >
                                                              </td>
                                                              <td>
                                                              <label id="emailVerplicht"></label>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                       <input type="tel" class="form-control" id="gsm" name="gsm" placeholder="GSM" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                                                              </td>
                                                              <td>
                                                              <label id="gsmVerplicht"></label>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                       <input type="password" class="form-control" id="paswoord" name="paswoord" placeholder="Paswoord*" required>
                                                              </td>
                                                              <td>
                                                              <label id="paswoordControle" class="fout"></label><label id="paswoordVerplicht" class="fout"></label>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                       <input type="password" class="form-control" id="paswoordB" name="paswoordB" placeholder="Paswoord bevestigen*" required>
                                                              </td><td>
                                                              <label id="paswoordBControle" class="fout"></label><label id="paswoordBVerplicht" class="fout"></label>
                                                              </td>
                                                          </tr>
                                                             <!-- 
                                                       <input type="text" class="form-control" name="postcode" placeholder="Postcode*" required>
                                                              <label id="postcodeVerplicht"></label>
                                                       <input type="text" class="form-control" name="gemeente" placeholder="Gemeente*" required>
                                                              <label id="gemeenteVerplicht"></label>
                                                              -->
                                                          <tr>
                                                              <td>
                                                       <input type="button" value="Account aanmaken" onclick="wijzig()" />
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                      <p>*Verplicht in te vullen</p>
                                                              </td>
                                                          </tr>
                                                      </table>
                                                  </form>
                                             </div>
    </body>
</html>