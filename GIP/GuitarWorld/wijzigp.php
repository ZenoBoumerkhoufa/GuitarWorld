<?php session_start(); ?>
<?php                        
                        
    if(isset($_SESSION["id"])){
      $id = $_SESSION["id"];                   
                        
        if(isset($_POST["verzenden"])){
            if(isset($_POST["naam"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblKlanten SET KlantNaam =? WHERE KlantNr = ".$id;
                        if($stmt = $mysqli->prepare($sql)){
                               $stmt->bind_param("s", $kf);
                            $kf = $_POST["invoer"];
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                               
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["omschrijving"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblproducten SET ProductOmschrijving = ? WHERE ProductId = ".$id;
                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("s", $kf);
                            $kf = $_POST["invoer"];
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["prijs"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                if(is_int($_POST["invoer"])){
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblproducten SET ProductPrijs = ? WHERE ProductId =".$id;
                        if($stmt = $mysqli->prepare($sql)){
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
                else{
                    ?><script type="text/javascript"> Document.getElementById("warning").innerHTML = "Gelieve een getal in te voeren als prijs"; </script><?php
                }
        }
     }
    }                        
?>




<!DOCTYPE html>
<html lang="en">
<head>

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
                        <li><a href="gitaren.php" class="smoothScroll">Shop</a></li>
                    </ul>

                    <!-- UITLOGGEN -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><form method="post"><input type="submit" name="uitloggen" id="uitloggen" value="Terug" class="section-btn"></form></li>
                    </ul>
                   <?php
                   if(isset($_POST["uitloggen"])){
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
                            <h2>Producten wijzigen</h2>
                            <span class="line-bar">...</span>
                        </div>
                        
                        <!-- VALUE'S -->                        
                        
<?php
                        $nr = "%";
        if(isset($_SESSION["id"]) && $_SESSION["id"] != ""){
            $nr = $_SESSION["id"];
                        
                $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                if(mysqli_connect_errno()){
                    trigger_error('Fout bij de verbinding: '.$mysqli->error);
                }
                else{
                    $sql = "select ProductId, ProductNaam, ProductOmschrijving, ProductPrijs from tblProducten where ProductId LIKE ?" ;
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("s",$zoek);
                        $zoek = "%".$nr."%";
                        if(!$stmt->execute()){
                            echo "Het uitvoeren van de query is mislukt: ".$stmt->error." in de query: ".$sql;
                        }
                        else{
                            $stmt->bind_result($id, $naam, $omschrijving, $prijs);
                            $stmt->fetch();
                        }
                    }
                }
        }
                            ?>
                        
                        <table border="2">
                            <tr><th>ProductId</th><th>ProductNaam</th><th>ProductOmschrijving</th><th>ProductPrijs</th></tr>
                            <tr><td><?php echo $id; ?></td><td><?php echo $naam; ?></td><td><?php echo $omschrijving; ?></td><td><?php echo $prijs; ?></td></tr>
                        </table>
                        

<!-- FORM PRODUCTEN -->
 <form id="form1" name="form1" method="post">
     <table>
         <tr><td>
Te wijzigen:
         
 <input type="radio" name="naam" id="naam" />Naam
         
 <input type="radio" name="familienaam" id="familienaam"/>Omschrijving
         
 <input type="radio" name="email" id="email"/>Prijs
             
         </td></tr>
         
         <tr><td><input type="text" name="invoer" id="invoer" /></td><td><label name="warning" id="warning"></label></td></tr>
         
         <tr><td>
 <input type="submit" name="verzenden" id="verzenden" value="wijzigen" />
             
 <input type="reset" name="wissen" id="wissen" value="wissen" />
         </td></tr>
     </table>
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