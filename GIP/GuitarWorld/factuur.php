<?php session_start(); ?>

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


     <!-- BLOG HEADER -->
     <section id="blog-header" data-stellar-background-ratio="0.5">
          <div class="overlay"></div>
          <div class="container">
               <div class="row">

                    <div class="col-md-offset-1 col-md-5 col-sm-12">
                         <h2>Factuur</h2>
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
                            <h2>Overzicht</h2>
                            <span class="line-bar">...</span>
                        </div>
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
                            <form action="bedankt.php" method="post">
                                 <!-- BESTELLING TONEN -->

<?php
    $totaal = 0;
    $producten = "";
    

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
                  $querries[$i] = "SELECT productId, ProductNaam, ProductPrijs FROM tblproducten WHERE productId = '$productiden[$i]'";
              }
              foreach ($querries as $querrie){
                  if($stmt = $mysqli->prepare($querrie)){
                      if(!$stmt->execute()){
                          echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$querrie;
                      }
                      else{
                          $stmt->bind_result($id, $productnaam, $prijs);
                           ?><table width=100% class="table"><?php
                          while($stmt->fetch()){
                            ?> <tr><td><?php echo $productnaam."</br>"; ?></td><td><?php echo $prijs; ?>€</td></tr>
                            <?php
                              $producten += $id." - ";
                              $totaal += $prijs; } ?></table><?php
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
    
                  ?><h2>TOTAAL:<?php echo $totaal."€"; ?></h2><?php
    
                                
                                
                                unset($_SESSION['count']);
                                unset($_SESSION['koopwaren']);
                                
                                ?>
                            
                                <input type="submit" name="bevestig" class="section-btn" id="bevestig" value="Bevestig">
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