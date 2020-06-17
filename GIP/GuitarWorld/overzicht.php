<?php session_start();
$productid =0 ; ?>


<!DOCTYPE html>
<html lang="en">
<head>
<style type=”text/css” >
.opmaak {border:10px solid red; }
table{
    border:10px solid red;

}
</style>
     <title>Guitarworld</title>
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

     <!-- PRE LOADER 
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>  -->


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
                         <li><a href="admin.php" class="smoothScroll">Admin-pagina</a></li>
                    </ul>

                    <!-- UITLOGGEN -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><form method="post"><input type="submit" name="terug" id="terug" value="Terug" class="section-btn"></form></li>
                    </ul>
                   <?php
                   if(isset($_POST["terug"])){
                       session_destroy();
                       header("location:admin.php");
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
                         <h2>Admin</h2>
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
                            <h2>Overzicht van bestellingen</h2>
                            <span class="line-bar">...</span>
                        </div>               
                       <table><tr><th style="border: 3px solid black; margin: 20px; padding: 20px">BestellingsId</th><th style="border: 3px solid black; margin: 20px; padding: 20px">Naam</th><th style="border: 3px solid black; margin: 20px; padding: 20px">Datum van bestelling</th><th style="border: 3px solid black; margin: 20px; padding: 20px">Leveradres</th><th style="border: 3px solid black; margin: 20px; padding: 20px">Product met prijs</th></tr>
                       <?php
                           
                       $mysqli = new MySQLi ("localhost","root","","guitarworld");
                       if(mysqli_connect_errno()){trigger_error('Fout bij de verbinding: '.$mysqli->error);}
                       else{
                           
                           $sql = "SELECT b.bestellingsId, KlantId, datum, Adres, huisnummer, postcode, k.KlantNaam, k.KlantFamilienaam, p.ProductNaam, p.ProductPrijs FROM tblbestellingen b JOIN tblklanten k ON b.KlantId = k.KlantNr JOIN tblbestellingenperorder a ON a.bestellingsId = b.bestellingsId JOIN tblproducten p ON a.productId = p.ProductId";
                           if($stmt = $mysqli->prepare($sql)){
                               if(!$stmt->execute()){
                                   echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query '.$sql;
                               }
                               else{
                                   $stmt->bind_result($bestellingsid, $klantid, $datum, $adres, $huisnummer, $postcode, $klantnaam, $klantfamilienaam, $productnaam, $productprijs);
                                   while($stmt->fetch()){
                                       ?> <tr><td style="border: 3px solid black; margin: 20px; padding: 20px"><?php echo $bestellingsid ; ?></td><td style="border: 3px solid black; margin: 20px; padding: 20px"><?php echo $klantnaam." ".$klantfamilienaam; ?></td><td style="border: 3px solid black; margin: 20px; padding: 20px"><?php echo $datum; ?></td><td style="border: 3px solid black; margin: 20px; padding: 20px"><?php echo $adres.", ".$huisnummer.", ".$postcode; ?></td><td style="border: 3px solid black; margin: 20px; padding: 20px"><?php echo $productnaam." - ".$productprijs."€"; ?></td> <?php
                                   }
                               }
                           }
                       }
                           
                       ?>
                            
                       </table>
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



     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>