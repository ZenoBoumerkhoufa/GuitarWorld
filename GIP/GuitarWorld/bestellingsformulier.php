<?php session_start(); ?>

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
                            
                            <form action="factuur.php" method="post">
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
                                 <input type="button" class="form-control" name="maken" id="maken" value=" Account Aanmaken" onclick="wijzig();">
                                 <p>*Verplicht in te vullen</p>
                                <input type="submit" name="bevestig" class="bevestig" id="bevestig" value="Bevestig">
                            </form>
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
     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>