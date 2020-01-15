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
<!-- PHP -->
<?php
session_start();
?>
















<!-- ADMIN INLOGGEN -->
    <?php
    if((isset($_POST["submit"])) && $_POST['email'] == 'admin@mail.com' && $_POST['paswoord'] == 'admin123'){
        header("location:admin.php");
        $_SESSION['ingelogged'] = 1;
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

                       $sql2 = " INSERT INTO tblKlanten (KlantNaam, KlantFamilienaam, KlantEmail, KlantGSM, KlantPaswoord ) VALUES (?,?,?,?,?)";

            if($stmt2 = $mysqli->prepare($sql2)) {
                $stmt2->bind_param('sssss',$klantnaam,$klantfamilienaam,$klantmail, $klantgsm, $klantpaswoord);
                $klantnaam = $mysqli->real_escape_string($_POST['naam']) ;
                $klantfamilienaam = $mysqli->real_escape_string($_POST['familienaam']) ;
                $klantmail=$mysqli->real_escape_string($_POST['email']) ;
                $klantgsm=$mysqli->real_escape_string($_POST['gsm']);
                $klantpaswoord=$mysqli->real_escape_string($_POST['paswoord']);

                if(!$stmt2->execute()){
                    echo 'het uitvoeren van de query is mislukt:';
                }
                else{
                    echo 'Het invoegen is gelukt';
                    $_SESSION['ingelogged'] = 1;
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

            $sql = 'SELECT KlantEmail, KlantPaswoord FROM tblKlanten';

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
                $_SESSION['ingelogged'] = 1;
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
                   <a href="index.html" class="navbar-brand"> GuitarWorld</a><img src="images/LOGO.png">
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="#home" class="smoothScroll">Home</a></li>
                        <li><a href="info.php" class="smoothScroll">Over ons</a></li>
                         <li><a href="contacten.php" class="smoothScroll">Contacten</a></li>
                    </ul>

                   <!-- IN OF UITLOGGEN -->
                   <?php
                        if(isset($_SESSION['ingelogged']) && $_SESSION['ingelogged'] == 1) { ?>

                    <ul class="nav navbar-nav navbar-right">
                         <li class="section-btn"><a href="homepage.php"  >Uitloggen</a></li>
                    </ul>

                    <?php session_destroy(); }
                         else{ ?>

                        <ul class="nav navbar-nav navbar-right">
                         <li class="section-btn"><a href="#" data-toggle="modal" data-target="#modal-form">Inloggen</a></li>
                    </ul>


                        <?php } ?>

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
                              <h1>GuitarWorld</h1>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="home-video">
                              <img src="images/gitaren_muur.jpg">
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- OVER ONS -->
     <section id="about" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-5 col-sm-6">
                         <div class="about-info">
                              <div class="section-title">
                                   <h2>Over ons</h2>
                                   <span class="line-bar">...</span>
                              </div>
                              <p>Hier bij GuitarWorld vind je alle verschillende elektrische gitaren voor beginners tot gevorderde. We hebben ook accessiores voor bij deze gitaren, van snaren en straps tot de verschillende gitaar kabels.</p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="about-image">
                              <img src="images/about-image.jpg" class="img-responsive" alt="">
                         </div>
                    </div>

               </div>
          </div>
     </section>

     <!-- FOTO -->
     <section id="work" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-3 col-sm-6">
                         <!-- WORK THUMB -->
                         <div class="work-thumb">
                              <a href="<!-- GITARENPAGINA -->">
                                   <img src="images/G_Les_Paul.jpg" class="img-responsive" alt="gitaren">

                                   <div class="work-info">
                                        <h3>Gitaren</h3>
                                   </div>
                              </a>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <!-- WORK THUMB -->
                         <div class="work-thumb">
                              <a href="<!-- ACCESSIORESPAGINA -->">
                                   <img src="images/F_Strap.jpg" class="img-responsive" alt="accessiores">

                                   <div class="work-info">
                                        <h3>Accessiores</h3>
                                   </div>
                              </a>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <!-- WORK THUMB -->
                         <div class="work-thumb">
                              <a href="contacten.php">
                                   <img src="images/contacten.jpg" class="img-responsive" alt="Work">

                                   <div class="work-info">
                                        <h3>Contacten</h3>
                                   </div>
                              </a>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <!-- WORK THUMB -->
                         <div class="work-thumb">
                              <a href="info.php">
                                   <img src="images/info.jpg" class="img-responsive" alt="Work">

                                   <div class="work-info">
                                        <h3>Informatie</h3>
                                   </div>
                              </a>
                         </div>
                    </div>

               </div>
          </div>
     </section>

     <!-- CONTACT -->
     <section id="contact" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>Contacteer ons</h2>
                              <span class="line-bar">...</span>
                         </div>
                    </div>

                    <div class="col-md-8 col-sm-8">

                         <!-- CONTACT FORM HERE -->
                         <form id="contact-form" role="form" action="#" method="post">
                              <div class="col-md-6 col-sm-6">
                                   <input type="text" class="form-control" placeholder="Volledige naam" id="cf-name" name="cf-name" required="">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <input type="email" class="form-control" placeholder="Email" id="cf-email" name="cf-email" required="">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <input type="tel" class="form-control" placeholder="gsm-nummer" id="cf-number" name="cf-number" required="">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <select class="form-control" id="cf-budgets" name="cf-budgets">
                                        <option>Budget</option>
                                        <option>€500 tot €1,000</option>
                                        <option>€1,000 tot €2,200</option>
                                        <option>€2,200 tot €4,500</option>
                                        <option>€4,500 tot €7,500</option>
                                        <option>€7,500 tot €12,000</option>
                                        <option>€12,000 of meer</option>
                                   </select>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <textarea class="form-control" rows="6" placeholder="Benodigdheden" id="cf-message" name="cf-message" required=""></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="submit" value="Verstuur">
                              </div>

                         </form>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="google-map">
	<!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
                              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.6201788570274!2d3.7162535155263283!3d51.04163547956129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3715ea5c997c9%3A0xc0c7fd5045b75af3!2sKortrijksesteenweg%2012%2C%209000%20Gent!5e0!3m2!1snl!2sbe!4v1574964123487!5m2!1snl!2sbe" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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
                                   <li><a href="#">Promoties</a></li>
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
