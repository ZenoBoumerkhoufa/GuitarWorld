<!-- PHP -->
<?php session_start(); ?>
<!-- ADMIN --> 
<?php

    if((isset($_POST["submit"])) && $_POST['email'] == 'admin@mail.com' && $_POST['paswoord'] == 'admin123'){
        header("location:admin.php");
        $_SESSION['ingelogged'] = 1;
    }
    ?>

<!-- KLANT AANMAKEN -->
    <?php
    if ((isset($_POST["submit"])) && (isset($_POST["naam"])) && (@$_POST["naam"] != "") && isset($_POST['familienaam']) && ($_POST['familienaam'] != "")){
        $mysqli= new MySQLi ("localhost","root","","guitarworld");
        
        if(mysqli_connect_errno()) {
            
            trigger_error('Fout bij verbinding: '.$mysqli->error);
            
        }
        else{
            
            $sql = " INSERT INTO tblKlanten (KlantNaam, KlantFamilienaam, KlantEmail, KlantGSM, KlantPaswoord ) VALUES (?,?,?,?,?)";
            
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param('sssss',$klantnaam,$klantfamilienaam,$klantmail, $klantgsm, $klantpaswoord);
                $klantnaam = $mysqli->real_escape_string($_POST['naam']) ;
                $klantfamilienaam = $mysqli->real_escape_string($_POST['familienaam']) ;
                $klantmail=$mysqli->real_escape_string($_POST['email']) ;
                $klantgsm=$mysqli->real_escape_string($_POST['gsm']);
                $klantpaswoord=$mysqli->real_escape_string($_POST['paswoord']);
                
                if(!$stmt->execute()){
                    //echo 'het uitvoeren van de query is mislukt:';
                }
                else{
                    //echo 'Het invoegen is gelukt';
                    $_SESSION['ingelogged'] = 1;
                }
                $stmt->close();
            }
            else{
                //echo 'Er zit een fout in de query'.$mysqli->error;
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
            $sql= "select KlantEmail, KlantPaswoord from tblKlanten";
            if($stmt = $mysqli->prepare($sql)) {
                if(!$stmt->execute()){
                    //echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                }
                else {
                    $stmt->bind_result($mail, $paswoord);
                    while($stmt->fetch()) {
                        $_SESSION['ingelogged'] = 1;
                    }
                }
                $stmt->close();
            }
            else {
                //echo 'Er zit een fout in de query: '.$mysqli->error;
            }
        }    
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>

     <title>Contacten</title>
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
                         <li><a href="info.php" class="smoothScroll">Over ons</a></li>
                         <li><a href="homepage.php#contact" class="smoothScroll">Contact</a></li>
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


     <!-- BLOG HEADER -->
     <section id="blog-header" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-5 col-sm-12">
                         <h2>Contacten</h2>
                    </div>
                    
               </div>
          </div>
     </section>


     <!-- BLOG DETAIL -->
     <section id="blog-detail" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-10 col-sm-12">
                         <!-- BLOG THUMB -->
                         <!-- CONTACT FORM HERE -->
                         <form id="contact-form" role="form" action="#" method="post">
                              <div class="col-md-6 col-sm-6">
                                   <input type="text" class="form-control" placeholder="Volledige naam" id="cf-name" name="cf-name" required="">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <input type="email" class="form-control" placeholder="Email" id="cf-email" name="cf-email" required=""><br>
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
                                  <br>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <textarea class="form-control" rows="6" placeholder="Benodigdheden" id="cf-message" name="cf-message" required=""></textarea><br>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="submit" value="Verstuur">
                              </div>

                         </form>
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
                                                  <form action="#" method="post">
                                                       <input type="text" class="form-control" name="naam" placeholder="Naam*" required>
                                                       <input type="text" class="form-control" name="familienaam" placeholder="Familienaam*" required>
                                                       <input type="email" class="form-control" name="email" placeholder="Email*" required>
                                                       <input type="tel" class="form-control" name="gsm" placeholder="GSM">
                                                       <input type="password" class="form-control" name="paswoord" placeholder="Paswoord*" required>
                                                       <input type="submit" class="form-control" name="submit" value="Inloggen">
                                                      <p>*Verplicht in te vullen</p>
                                                  </form>
                                             </div>

                                             <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                                  <form action="#" method="post">
                                                       <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                       <input type="password" class="form-control" name="paswoord" placeholder="Paswoord" required>
                                                       <input type="submit" class="form-control" name="submit" value="Inloggen">
                                                       <!-- link voor paswoord vergeten? bijplaatsen -->
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