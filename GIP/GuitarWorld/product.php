Hier komt de uitgebreide beschrijving van een product en de prijs samen met de mogelijkheid om deze toe te voegen aan uw bestelling
<?php session_start(); ?>
<?php
if(isset($_SESSION["product"]) && $_SESSION["product"] != ""){
    $nm = $_SESSION["product"];
    $mysqli= new MySQLi ("localhost","root","","guitarworld");
if(mysqli_connect_errno()) {
    trigger_error('Fout bij verbinding: '.$mysqli->error); 
}
    else{
        $sql = "SELECT ProductNaam, ProductOmschrijving, ProductPrijs, ProductFoto FROM tblProducten WHERE ProductNaam = '".$nm."'";
        if($stmt = $mysqli->prepare($sql)){
            if(!$stmt->execute()){
            echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
            }
            else{
                $stmt->bind_result($naam, $omschrijving, $prijs, $foto);
                $stmt->fetch();
                    //OPVULLING VAN DE PAGINA
            }
        }
    }
    $stmt->close();
}
else{
    echo 'Er zit een fout in de query: '.$mysqli->error;
}
?>