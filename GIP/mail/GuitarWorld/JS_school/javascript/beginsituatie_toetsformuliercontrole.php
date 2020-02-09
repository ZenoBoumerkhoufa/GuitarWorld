<!DOCTYPE html>
<html>
<head>




<script type="text/javascript"> 
 
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
<form name="inlogpagina" id="inlogpagina" method="post" action="aangemeld.php">
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
Plaats hier je knop "inloggen"
</td>
</tr>
</table>
</form>
</body>
</html>
