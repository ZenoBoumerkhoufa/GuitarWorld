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



  Schrijf hier je controles




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
<td><input type="text" name="rij" id="rij"  ></td>
<td><label id="rijVerplicht" class="fout"></label></td>
</tr>
<tr>
<tr>
<td><label for="kolom">Kolommen:</label></td>
<td><input type="text" name="kolom" id="kolom" ></td>
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


Werk hier de tabel verder af


</table>

<?php
}
?>


</body>
</html>
