<style type="text/css">
.oneven {
	background-color: #0FF;
}
.even {
	background-color: #FF3;
}
</style>




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