<?php session_start(); ?>
<?php
$nummer = 0;
$klantnummer = 0;
$mysqli= new MySQLi ("localhost","root","","guitarworld");

if(isset($_GET["productid"]) && $_GET["productid"] != ""){
    $id = mysqli_real_escape_string($mysqli, $_GET["productid"]);
if(mysqli_connect_errno()) {
    trigger_error('Fout bij verbinding: '.$mysqli->error); 
}
    else{
        $sql = "SELECT ProductNaam, ProductOmschrijving, ProductPrijs, ProductFoto FROM tblProducten WHERE ProductId = ".$id;
        if($stmt = $mysqli->prepare($sql)){
            if(!$stmt->execute()){
            // echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
            }
            else{
                $stmt->bind_result($naam, $omschrijving, $prijs, $foto);
                $stmt->fetch();
            }
        }
    }
    $stmt->close();
}
else{
    echo 'Er zit een fout in de query: '.$mysqli->error;
}
?>

<script type="text/javascript">
    



function wijzig()
{



   var ok = true;
if (document.getElementById("naam").value=="Naam**" || document.getElementById("naam").value=="" ){
    document.getElementById("naamVerplicht").innerHTML="Gelieve een naam in te vullen";
    ok=false;

        }
    else{
        document.getElementById("naamVerplicht").innerHTML="";

    }
if(document.getElementById("familienaam").value == ""){
    document.getElementById("familienaamVerplicht").innerHTML="Gelieve een familienaam in te vullen";
    ok=false;
}
    else{
        document.getElementById("familienaamVerplicht").innerHTML="";
    }
if(document.getElementById("email").value == ""){
    document.getElementById("emailVerplicht").innerHTML="Gelieve een email in te vullen";
    ok=false;
}
    else{
        document.getElementById("emailVerplicht").innerHTML="";
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
         document.getElementById("paswoordControle").innerHTML="Ongeldig paswoord, bevat minstens 1 cijfer en 1 hoofdletter en kleine letter, minimum 8 karakters";
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

if(document.getElementById("postcode").value == ""){
    document.getElementById("postcodeVerplicht").innerHTML="Gelieve een postcode in te vullen";
    ok=false;
}
    else{
        document.getElementById("postcodeVerplicht").innerHTML="";
    }
    if(document.getElementById("gemeente").value == ""){
        document.getElementById("gemeenteVerplicht").innerHTML="Gelieve een gemeente in te vullen";
        ok=false;
    }
    else{
        document.getElementById("gemeenteVerplicht").innerHTML="";
    }
    
    if(document.getElementById("straat").value == ""){
        document.getElementById("straatVerplicht").innerHTML="Gelieve uw Straatnaam in te vullen";
        ok=false;
    }
    else{
        document.getElementById("straatVerplicht").innerHTML="";
    }
    if(document.getElementById("huisnummer").value == ""){
        document.getElementById("huisnummerVerplicht").innerHTML = "Gelieve uw huisnummer in te vullen";
        ok=false;
    }
    else{
        document.getElementById("huisnummerVerplicht").innerHTML="";
    }


    if (ok==true){

    document.accountmaken.submit();
}

}

</script>
 <style type="text/css">
    .fout {
	color: #F00;
}
    </style>

<!-- ADMIN INLOGGEN -->
    <?php
    if((isset($_POST["submit"])) && $_POST['email'] == 'admin@mail.com' && $_POST['paswoord'] == 'Admin123'){
        $_SESSION['ingelogged'] = 1;
        header("location:admin.php");
    }
    ?>


    <!-- KLANT AANMAKEN -->
    <?php

    if ( (isset($_POST["naam"])) && (@$_POST["naam"] != "")){

        $mail = $_POST["email"];
        $paswoord = $_POST["paswoord"];

        $mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno()) {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }
        else{
            
            $sqlp = "SELECT PostcodeId FROM tblgemeente";
            if(isset($_POST["gemeente"]) && $_POST["gemeente"] != ""){
                $sqlp = $sqlp." WHERE Gemeente = '".$_POST["gemeente"]."'";
            }
            if(isset($_POST["postcode"]) && $_POST["postcode"] != ""){
                $sqlp = $sqlp." AND PCode = '".$_POST["postcode"]."'";
            }
            if($stmt = $mysqli->prepare($sqlp)){
                if(!$stmt->execute()){
                    echo "Het uitvoeren van de query is mislukt: ".$stmt->error." in query: ".$sql2;
                }
                else{
                    $stmt->bind_result($postcodeid);
                    while($stmt->fetch()){
                        echo "hallo";
                    }
                    
                }
                                
            }
            else{
                echo "er zit een fout in de query";
            }
                
            $sql = 'SELECT count(*) as aantal FROM tblKlanten where KlantEmail=? ';




            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('s',$mail);
                if(!$stmt->execute()){

                    echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                }
                else {
                    $stmt->bind_result($aantal);
                    while($stmt->fetch()) {
                    }

                    if ($aantal ==0){

                      $sql2 = " INSERT INTO tblKlanten (KlantNaam, KlantFamilienaam, KlantEmail, KlantGSM, KlantPaswoord, PostcodeId, KlantStraat, KlantHuisnummer ) VALUES (?,?,?,?,?,?,?,?)";

            if($stmt2 = $mysqli->prepare($sql2)) {
                $stmt2->bind_param('sssssiss',$klantnaam,$klantfamilienaam,$klantmail, $klantgsm, $klantpaswoord, $postid, $straat, $nummer);
                $klantnaam = $mysqli->real_escape_string($_POST['naam']) ;
                $klantfamilienaam = $mysqli->real_escape_string($_POST['familienaam']) ;
                $klantmail=$mysqli->real_escape_string($_POST['email']) ;
                $klantgsm=$mysqli->real_escape_string($_POST['gsm']);
                $klantpaswoord=$mysqli->real_escape_string($_POST['paswoord']);
                $postid = $mysqli->real_escape_string($postcodeid);
                $straat = $mysqli->real_escape_string($_POST["straat"]);
                $nummer = $mysqli->real_escape_string($_POST["huisnummer"]);
                

                if(!$stmt2->execute()){
                    echo 'het uitvoeren van de query is mislukt:';
                }
                else{
                    echo 'Het invoegen is gelukt';
                    $_SESSION['ingelogged'] = $klantmail;
                    $_SESSION["naam"] = $klantnaam;
                }
                $stmt2->close();
            }
            else{
                ///echo 'Er zit een fout in de query'.$mysqli->error;
            }
                    }

                   else{

                       echo "je account bestaat al";

                   }

                }
            }
            else {
                ///echo 'Er zit een fout in de query: '.$mysqli->error;
            }
        }
     
    }

?>


     <!--- KLANT INLOGGEN --->
    <?php
    if ((isset($_POST["submit"])) && (isset($_POST["email"])) && ($_POST["email"] != "") && isset($_POST['paswoord']) && ($_POST['paswoord'] != "")){

        $mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno()) {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }
        else{

            $sql = 'SELECT KlantEmail, KlantNaam FROM tblKlanten WHERE KlantEmail = ? AND KlantPaswoord = ?';

            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('ss',$mail,$paswoord);
                $mail = $_POST["email"];
                $paswoord = $_POST["paswoord"];
                if(!$stmt->execute()){
                    ///echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                }
                else {
                    $stmt->bind_result($mail_persoon, $naam);
                    while($stmt->fetch()) {
                       $_SESSION['ingelogged'] = $mail_persoon;
                       $_SESSION["naam"] = $naam;
                        $_SESSION["id"] = $id;
                    }
                }
                $stmt->close();
            }
            else {
                ///echo 'Er zit een fout in de query: '.$mysqli->error;
            }
        }
    }
    ?>


<!DOCTYPE html>
<html lang="en">
<head>

     <title>GuitarWorld</title>

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

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- LOGO TEXT -->
                   <a href="homepage.php" class="navbar-brand"> GuitarWorld</a><img src="images/LOGO.png">
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="homepage.php" class="smoothScroll">Home</a></li>
                        <li><a href="info.php" class="smoothScroll">Over ons</a></li>
                         <li><a href="gitaren.php" class="smoothScroll">Shop</a></li>
                        <li><a href="Winkelwagentje.php"><img src="images/cart.png"></a></li>
                    </ul>

                  <!-- IN OF UITLOGGEN -->
                   <?php if(isset($_SESSION['ingelogged'])) { ?>
                    <ul class="nav navbar-nav navbar-right">
                         <li class="navbar-brand"><?php echo $_SESSION["naam"]; ?></li>
                        <li><form  method="post" action="homepage.php" ><input type="submit" name="uitloggen" id="uitloggen" value="Uitloggen" class="section-btn"></form></li>
                    </ul>
                    <?php } else{ ?>
                    <ul class="nav navbar-nav navbar-right">
                         <li class="section-btn"><a href="#" data-toggle="modal" data-target="#modal-form">Inloggen</a></li>
                    </ul>
                   <?php }
                   if(isset($_POST["uitloggen"])){
                       session_destroy();
                   } 
                   ?>
               </div>
          </div>
     </section>


     <!-- HOME -->
     <section id="home" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="home-info">
                              <h1><b><?php echo $naam; ?></b></h1>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="home-video">
                             <h1><b></b></h1>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- PRODUCT -->
     <section id="about" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-10 col-sm-6">
                         <div class="about-info">
                              <div class="section-title">
                              </div>
                              <table width=100% margin=20px>
                                  <tr>
                                      <td>
                                          <?php echo "<img src='images/producten/".$foto."'>"; ?>
                                      </td>
                                      <td>
                                          <b>
                                              <?php echo "<h3>".$prijs."€</h3><br>"; ?>
                                          </b>
                                          <b>
                                              <?php echo $omschrijving; ?>
                                        
                                          </b>
                                      </td>
                                      <td>
                                          
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <br>
                                          <form method="post">
                                              <input type="submit" id="toevoegen" name="toevoegen" class="section-btn" value="Toevoegen aan winkelmandje">
                                          </form>
                                          <br>
                                          <br>
                                      </td>
                                  </tr>
                              </table>
                         </div>
                    </div>

                    
         </div>
    </div>
    </section>
    
    <?php
    if(isset($_POST["toevoegen"])){
        $i = 0;
        while( $i < $_SESSION["count"]){
            if($_SESSION["koopwaren"][$i] == $id) {
                $erdoor = true;
                $herhaling = $i;    
            }
            $i++;
        }
        if (isset($erdoor)) {
            
        }
        else{
            $_SESSION["koopwaren"][$_SESSION["count"]] = $id;
            $_SESSION["count"]++;
        }
    }
    if(!isset($_SESSION["count"])){
        $_SESSION["count"] = 0;
    }
    ?>
    
<div class="col-md-4 col-sm-12">
                         <div class="about-image">
                              <img src="images/about-image.jpg" class="img-responsive" alt="">
                         </div>
                    </div>

     <!-- FOOTER -->
     <footer data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-5 col-sm-12">
                         <div class="footer-thumb footer-info">
                              <h2>GuitarWorld</h2>
                              <p>Een wereld vol gitaren voor iedereen.</p>
                         </div>
                    </div>

                    <div class="col-md-2 col-sm-4">
                         <div class="footer-thumb">
                              <h2>Bedrijf</h2>
                              <ul class="footer-link">
                                   <li><a href="info.php">Over ons</a></li>
                              </ul>
                         </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                         <div class="footer-bottom">
                              <div class="col-md-6 col-sm-5">
                                   <div class="copyright-text">
                                        <p>Copyright &copy; 2019 GuitarWorld</p>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </footer>


     <!-- MODAL -->
     <section class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
               <div class="modal-content modal-popup">

                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>

                    <div class="modal-body">
                         <div class="container-fluid">
                              <div class="row">

                                   <div class="col-md-12 col-sm-12">
                                        <div class="modal-title">
                                             <h2>GuitarWorld</h2>
                                        </div>

                                        <!-- NAV TABS -->
                                        <ul class="nav nav-tabs" role="tablist">
                                             <li class="active"><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">Maak een account</a></li>
                                             <li><a href="#sign_in" aria-controls="sign_in" role="tab" data-toggle="tab">Inloggen</a></li>
                                       </ul>

                                        <!-- TAB PANES -->
                                        <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                                  <form action="homepage.php" method="post" name="accountmaken" id="accountmaken">
                                                       <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam*" >
                                                       <label id="naamVerplicht" class="fout"></label>
                                                       <input type="text" class="form-control" name="familienaam" id="familienaam" placeholder="Familienaam*" required>
                                                       <label id="familienaamVerplicht" class="fout"></label>
                                                       <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required>
                                                       <label id="emailVerplicht" class="fout"></label>
                                                       <input type="tel" class="form-control" name="gsm" id="gsm" placeholder="GSM">
                                                       <input type="password" class="form-control" name="paswoord" id="paswoord" placeholder="Paswoord*" required>
                                                    <label id="paswoordControle" class="fout"></label><label id="paswoordVerplicht" class="fout"></label>
                                                       <input type="password" class="form-control" name="paswoordConfirm" id="paswoordConfirm" placeholder="Paswoord bevestigen*" required>
                                                      <label id="paswoordConfirmControle" class="fout"></label><label id="paswoordConfirmVerplicht" class="fout"></label>
                                                       <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode*" required>
                                                      <label id="postcodeVerplicht" class="fout"></label>
                                                       <input type="text" class="form-control" name="gemeente" id="gemeente" placeholder="Gemeente*" required>
                                                      <label id="gemeenteVerplicht" class="fout"></label>
                                                      <input type="text" class="form-control" name="straat" id="straat" placeholder="Straat*" required>
                                                      <label id="straatVerplicht" class="fout"></label>
                                                      <input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnummer*" required>
                                                      <label id="huisnummerVerplicht" class="fout"></label>                                                      
                                                       <input type="button" class="section-btn" name="maken" id="maken" value=" Account Aanmaken" onclick="wijzig();">
                                                      <p>*Verplicht in te vullen</p>
                                                  </form>
                                             </div>

                                             <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                                  <form action="#" method="post">
                                                       <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                       <input type="password" class="form-control" name="paswoord" placeholder="Paswoord"required>
                                                       <input type="submit" class="section-btn" name="submit" id="submit" value="Inloggen">
                                                  </form>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>



</body>
</html>