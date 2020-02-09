<!DOCTYPE html>
<html>
<head>

<style type="text/css">
.oneven {
	background-color: #0FF;
}
.even {
	background-color: #FF3;
}

.fout {
	color: #F00;
}
    </style>


<script type="text/javascript"> 
        
 function wijzig()
{
var ok = true;


if (document.getElementById("rij").value==""){
    document.getElementById("rijVerplicht").innerHTML="Gelieve het aantal rijen in te vullen";
    ok=false;
        }
    else{
        document.getElementById("rijVerplicht").innerHTML="";
    
if (isNaN(document.getElementById("rij").value)){
    document.getElementById("rijVerplicht").innerHTML="Gelieve een getal in de rij in te vullen";

    ok=false;
        }
    else{
        document.getElementById("rijVerplicht").innerHTML="";
		
		
		if ( (eval(document.getElementById("rij").value) >30)    || ( eval(document.getElementById("rij").value) <= 0)){
    document.getElementById("rijVerplicht").innerHTML="Gelieve het aantal rijen tussen 0 en 30 in te vullen";
    ok=false;
        }
    else{
        document.getElementById("rijVerplicht").innerHTML="";
		
	}
		
		
		
	}
	
	
	
	
	}
 
 
if (document.getElementById("kolom").value==""){
    document.getElementById("kolomVerplicht").innerHTML="Gelieve het aantal kolommen in te vullen";
    ok=false;
        }
    else{
        document.getElementById("kolomVerplicht").innerHTML="";
    
if (isNaN(document.getElementById("kolom").value)){
    document.getElementById("kolomVerplicht").innerHTML="Gelieve een getal in de kolom in te vullen";

    ok=false;
        }
    else{
        document.getElementById("kolomVerplicht").innerHTML="";
		
		
		if ( (eval(document.getElementById("kolom").value) >10)    || ( eval(document.getElementById("kolom").value) <= 0)){
    document.getElementById("kolomVerplicht").innerHTML="Gelieve het aantal kolommen tussen 0 en 10 in te vullen";
    ok=false;
        }
    else{
        document.getElementById("kolomVerplicht").innerHTML="";
		
	}
		
		
		
	}
	
	
	
	
	}
  

if (ok==true){
	
	<?php
	
	if (isset($_POST["rij"]) && $_POST["rij"] != "") {

	$_POST["verzenden"]="goed";
	}
	?>
	
	
    document.tabellen.submit();
}
   
   
   
   
    
}
   

        

</script>

    
   
   
</head>
<body>
 

<div class="hoofding">
<p>

 
Tabellen opvullen
</p>
</div>
<form name="tabellen" id="tabellen" method="post" action="tabelmetphponderaanpagina.php">
<table cellspacing="4">
<tr>
<td><label for="rij">Rijen:</label></td>
<td><input type="text" name="rij" id="rij" value="<?php if (isset($_POST["rij"]) && $_POST["rij"] != ""){echo $_POST["rij"];}  ?>" ></td>
<td><label id="rijVerplicht" class="fout"></label></td>
</tr>
<tr>
<tr>
<td><label for="kolom">Kolommen:</label></td>
<td><input type="text" name="kolom" id="kolom" value="<?php if (isset($_POST["kolom"]) && $_POST["kolom"] != ""){echo $_POST["kolom"];}  ?>"></td>
<td><label id="kolomVerplicht" class="fout"></label></td>
</tr>
<tr>
<tr>
<td></td>
<td>
<input type="button" value="tabel aanmaken" onclick="wijzig()" name="verzenden" />
</td>
</tr>
</table>
</form>
<?php



if (isset($_POST["verzenden"]) && $_POST["verzenden"] =="goed"){
	?>
<table border="1" width=50%>

<?php
$getal=0;
for($teller =1 ; $teller <= $_POST["rij"]; $teller++){
	if (($teller %2) ==0){
		
		echo "<tr class='even'>";
		}
	
	else
	{
			echo "<tr class='oneven'>";
		}
	
	?>
    
<?php
	for($teller1 =1 ; $teller1 <= $_POST["kolom"]; $teller1++){
		
	
	
	
	?>
    <td>
    <?php
	$getal +=1;
	echo $getal;
	
	?>
    
    </td>
    <?php
	
	}
    
    
    ?>
    </tr>
    <?php
	}



?>
</table>

<?php
}
?>


</body>
</html>
