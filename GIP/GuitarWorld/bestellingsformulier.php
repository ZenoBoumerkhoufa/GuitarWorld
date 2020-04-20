<?php session_start(); ?>

<script>
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
if (document.getElementById("straat").value==""){
    document.getElementById("straatVerplicht").innerHTML="Gelieve een straatnaam in te vullen";
    ok=false;
        }
    else{
        document.getElementById("straatVerplicht").innerHTML="";
    }
  if (document.getElementById("huisnummer").value==""){
    document.getElementById("huisnummerVerplicht").innerHTML="Gelieve een huisnummer in te vullen";
    ok=false;
        }
    else{
        document.getElementById("huisnummerVerplicht").innerHTML="";
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

    document.bevestiging.submit();
}

}

</script>
 <style type="text/css">
    .fout {
	color: #F00;
}
    </style>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>Bestelling</title>
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
                         <h2>Bestelling</h2>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- BLOG DETAIL -->
    <section id="blog-detail" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                        <div class="section-title">
                            <h2>Bestellingsformulier</h2>
                            <span class="line-bar">...</span>
                        </div>
                    </div>
              </div>
        </div>
    </section>
                         <!-- FORMULIER -->
     <section id="blog-detail" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                        <div class="col-md-3 col-sm-6">
                            <form action="factuur.php" name="bevestiging" id="bevestiging" method="post">
                                 <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam*" >
                                 <label id="naamVerplicht" class="fout"></label>
                                 <input type="text" class="form-control" name="familienaam" id="familienaam" placeholder="Familienaam*" required>
                                 <label id="familienaamVerplicht" class="fout"></label>
                                 <input type="email" class="form-control" name="email" id="email" placeholder="Email*" required>
                                 <label id="emailVerplicht" class="fout"></label>
                                 <input type="tel" class="form-control" name="gsm" id="gsm" placeholder="GSM">
                                 <label></label>
                                 <input type="text" class="form-control" name="straat" id="straat" placeholder="Straat*" required>
                                 <label id="straatVerplicht" class="fout"></label>
                                 <input type="huisnummer" class="form-control" name="huisnummer" id="huisnummer" placeholder="Huisnummer*" required>
                                 <label id="huisnummerVerplicht" class="fout"></label>
                                 <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode*" required>
                                 <label id="postcodeVerplicht" class="fout"></label>
                                 <input type="text" class="form-control" name="gemeente" id="gemeente" placeholder="Gemeente*" required>
                                 <label id="gemeenteVerplicht" class="fout"></label>
                                 <p>*Verplicht in te vullen</p>
                                <input type="submit" name="bevestig" class="section-btn" id="bevestig" value="Bevestig" onclick="wijzig();">
                            </form>                            
                        </div> 
                   </div>
              </div>
        </div>
    </section>

<?php
    
    if(isset($_POST['bevestig'])){
        $mysqli = new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno()){trigger_error('Fout bij de verbinding:'.$mysqli->error);}
        else{
            sql = "INSERT INTO tblbestellingen (KlantId, productId, datum, Adres, huisnummer, postcode ) VALUES (?,?,?,?,?,?)";
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param('iis',$klant,$producten,$datum,$adres,$huisnummer,$postcode);
                $klant = $mysqli->real_escape_string($_POST['naam'] + $_POST['familienaam']);
                
                
                
                
                
                
                if(isset($_SESSION["ingelogged"])){
        if($_SESSION["count"] != 0){
          $mysqli = mysqli_connect('localhost', 'root', '', 'guitarworld');
          if(mysqli_connect_errno()) {
              trigger_error('Fout bij verbinding: '.$mysqli->error);
          }
          else {
              for ($y=0; $y < $_SESSION['count']; $y++) {
                  $productiden[$y] = $_SESSION["koopwaren"][$y];
              }
              $querries = array();
              for ($i=0; $i < $_SESSION['count']; $i++) {
                  $querries[$i] = "SELECT ProductNaam, ProductOmschrijving, ProductPrijs, ProductFoto FROM tblproducten WHERE productId = '$productiden[$i]'";
              }
              foreach ($querries as $querrie){
                  if($stmt = $mysqli->prepare($querrie)){
                      if(!$stmt->execute()){
                          echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$querrie;
                      }
                      else{
                          $stmt->bind_result($productnaam, $beschrijving, $prijs, $foto);
                          while($stmt->fetch()){ 
                              $prodcten += $productnaam;
                          }
                            
                      }
                 }
              }
            }
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Je bent niet ingelogged');</script>";
        header("location:homepage.php");
    }
                
                
                
date_default_timezone_set('Europe/Brussels');
$datum = date('m/d/Y h:i:s a', time());
                $adres = $mysqli->real_escape_string($_POST['straat']);
                $huisnummer = $mysqli->real_escape_string($_POST['huisnummer']);
                $postcode = $mysqli->real_escape_string($POST['postcode']);
                
                
            }
        }
    }
    
    ?>
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
     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>