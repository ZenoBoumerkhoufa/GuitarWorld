<?php session_start(); ?>
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

                       $sql2 = " INSERT INTO tblKlanten (KlantNaam, KlantFamilienaam, KlantEmail, KlantGSM, KlantPaswoord, PostcodeId ) VALUES (?,?,?,?,?,?)";

            if($stmt2 = $mysqli->prepare($sql2)) {
                $stmt2->bind_param('sssssi',$klantnaam,$klantfamilienaam,$klantmail, $klantgsm, $klantpaswoord, $postid);
                $klantnaam = $mysqli->real_escape_string($_POST['naam']) ;
                $klantfamilienaam = $mysqli->real_escape_string($_POST['familienaam']) ;
                $klantmail=$mysqli->real_escape_string($_POST['email']) ;
                $klantgsm=$mysqli->real_escape_string($_POST['gsm']);
                $klantpaswoord=$mysqli->real_escape_string($_POST['paswoord']);
                $postid = $mysqli->real_escape_string($postcodeid);
                

                if(!$stmt2->execute()){
                    echo 'het uitvoeren van de query is mislukt:';
                }
                else{
                    echo 'Het invoegen is gelukt';
                    $_SESSION['ingelogged'] = $klantnaam;
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
        $mail = $_POST["email"];
        $paswoord = $_POST["paswoord"];
        
        $mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno()) {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }
        else{
            
            $sql = 'SELECT KlantEmail, KlantPaswoord FROM tblKlanten WHERE KlantEmail = "'.$mail.'" AND KlantPaswoord = "'.$paswoord.'"';
            if($stmt = $mysqli->prepare($sql)) {
                if(!$stmt->execute()){
                    ///echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                }
                else {
                    $stmt->bind_result($mail, $paswoord);
                    while($stmt->fetch()) {
                        
                    }
                }
                $stmt->close();
                $_SESSION['ingelogged'] = $mail;
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
<!-- 
Hydro Template 
http://www.templatemo.com/tm-509-hydro
-->
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

                    <!-- lOGO TEXT HERE -->
                    <a href="homepage.php" class="navbar-brand">GuitarWorld</a><img src="images/LOGO.png">
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="homepage.php#home" class="smoothScroll">Home</a></li>
                         <li><a href="homepage.php#about" class="smoothScroll">Over ons</a></li>
                         <li><a href="gitaren.php" class="smoothScroll">Shop</a></li>
                        <li><img src="images/cart.png"></li>
                    </ul>

                     <!-- IN OF UITLOGGEN -->
                   <?php if(isset($_SESSION['ingelogged'])) { ?>
                    <ul class="nav navbar-nav navbar-right">
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


     <!-- BLOG HEADER -->
     <section id="blog-header" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-5 col-sm-12">
                         <h2>Gitaren</h2>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- PRODUCTEN -->
     <section id="blog-detail" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                        <div class="col-md-3 col-sm-6">
                            
                            <!---ZOEKBALK--->
                            
                            <form method="post">
                            <input id="artikelzoeken" type="search" name="artikelzoeken" value="" placeholder="Zoeken naar...." autocomplete="off">
                            </form>
                            
                            <table width=80% margin=10 padding=10>
                            
                            <?php
                            
                            if(isset($_POST["artikelzoeken"])){
                                $zoek1 = $_POST["artikelzoeken"];
                            }else
                            {
                                $zoek1 = "%";
                            }
                                
                             $mysqli= new MySQLi ("localhost","root","","guitarworld");
if(mysqli_connect_errno()) {
    trigger_error('Fout bij verbinding: '.$mysqli->error); 
}
    else{
        $sql = "SELECT ProductNaam, ProductOmschrijving, ProductPrijs, ProductFoto FROM tblProducten WHERE ProductNaam LIKE ?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s",$zoek);
            $zoek = "%".$zoek1."%";
            if(!$stmt->execute()){
            echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
            }
            else{
                $stmt->bind_result($naam, $omschrijving, $prijs, $foto);
                $a = 1;
                while($stmt->fetch()){
                    echo "<td><a href='product.php'>
                    <img src='images/producten/".$foto."' alt='".$naam."'>
                    <div><h3>'".$naam."'</h3><br>".$omschrijving."<br><h3>".$prijs."€</h3></div>
                    </div></a></td>";
                    $_SESSION["product"] = $naam;
                    if($a % 4 == 0){
                        echo "</tr><tr>";
                    }
                    $a++;
                }
            }
        $stmt->close();
        }
        else{
            echo 'Er zit een fout in de query: '.$mysqli->error;
        }
    }
                            
                            
                            ?>
                                </table>
                        </div>
                    </div>
               </div>
          </div>
    </section>


     <!-- FOOTER -->
     <footer data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-5 col-sm-12">
                         <div class="footer-thumb footer-info"> 
                              <h2>GuitarWorld</h2>
                              <p>Een wereld vol gitaren en accessiores voor iedereen.</p>
                         </div>
                    </div>

                    <div class="col-md-2 col-sm-4"> 
                         <div class="footer-thumb"> 
                              <h2>Bedrijf</h2>
                              <ul class="footer-link">
                                   <li><a href="info.php">Over ons</a></li>
                                  <li><a href="contacten.php">Contact</a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-2 col-sm-4"> 
                         <div class="footer-thumb"> 
                              <h2>Services</h2>
                              <ul class="footer-link">
                                   <li><a href="#">2de hands</a></li>
                                   <li><a href="#">Garantie</a></li>
                                   <li><a href="#">Promotie's</a></li>
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
                                                       <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam**" >
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
                                                       <input type="button" class="form-control" name="maken" id="maken" value=" Account Aanmaken" onclick="wijzig();">
                                                      <p>*Verplicht in te vullen</p>
                                                  </form>
                                             </div>

                                             <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                                  <form action="#" method="post">
                                                       <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                       <input type="password" class="form-control" name="paswoord" placeholder="Paswoord"required>
                                                       <input type="submit" class="form-control" name="submit" value="Inloggen">
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