

<?php session_start(); ?>




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
                            <li><form method="post"><input type="submit" name="uitloggen" id="uitloggen" value="Uitloggen" class="section-btn"></form></li>
                    </ul>
                   <?php
                   if(isset($_POST["uitloggen"])){
                       session_destroy();
                       header("location:homepage.php");
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
                            
                            <span class="line-bar">...</span>
                        </div>

                       <table   width=100%  >
                           <tr><td style="border: 3px solid black; margin: 20px; padding: 20px">
                               <h2>Klanten zoeken en wijzigen</h2>
                                <p>Zoeken en wijzigen van klanten en hun gegevens.</p>
 <form id="form1" name="form1" method="post">

     <table>
         <tr><td>
 Klantnummer:
             </td><td>
 <input type="text" name="klantnummer" id="klantnummer" placeholder="Klantnr">
             </td></tr>
         <tr><td>
Naam:
             </td><td>
 <input type="text" name="naam" id="naam" placeholder="naam" />
             </td></tr>
         <tr><td>
Familienaam:
             </td><td>
 <input type="text" name="familienaam" id="familienaam" placeholder="familienaam">
             </td></tr>
         <tr><td>
Email:
             </td><td>
 <input type="email" name="email" id="email" placeholder="email" />
             </td></tr>
         <tr><td>
GSM:
             </td><td>
 <input type="text" name="gsm" id="gsm" placeholder="gsm" />
             </td></tr>
             <tr><td>
 <input type="submit" name="verzenden" id="verzenden" value="Zoeken" />
             </td><td>
 <input type="reset" name="wissen" id="wissen" value="wissen" />
             </td></tr>
     </table>
</form>
                               </td>
                           
                           <td  style="border: 3px solid black; margin: 20px; padding: 20px">
                                <h2>Producten zoeken en wijzigen</h2>
                                <p>Zoeken en wijzigen van Producten en hun gegevens.</p>
<form id="form1" name="form1" method="post">
    
   
                           <table>
            <tr><td>
    ProductId:
                </td><td>
    <input type="text" name="id" id="id" placeholder="ProductId">
                </td></tr>
            <tr><td>
                Naam:
                </td><td>
    <input type="text" name="naam" id="naam" placeholder="naam" />
                </td></tr>
                               <tr>
                               <td>
                                   
                                    &nbsp;
                                   
                                   </td>
                               </tr>
                               <tr>
                               <td>
                                   
                                    &nbsp;
                                   
                                   </td>
                               </tr>
                <tr><td>
    <input type="submit" name="verzenden2" id="verzenden2" value="Zoeken" />
                    </td><td>
    <input type="reset" name="wissen" id="wissen" value="wissen" />
                    </td></tr>
        </table>
                       
</form>
   <form method="post" action="toevoegen.php"><input type="submit" value="Toevoegen"></form>
                               
                               
                               
                               
                               
                               
                               
                               
                               </td>
                           
                           
                           
                           
                           
                           </tr>                     
                        
    </table>                    
                        
                        <!-- TONEN -->
<?php
        if(isset($_POST["verzenden"])){
            if(isset($_POST["klantnummer"]) && $_POST["klantnummer"] != ""){
                $klantnummer = $_POST["klantnummer"];
                $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                if(mysqli_connect_errno()){
                    trigger_error('Fout bij de verbinding: '.$mysqli->error);
                }
                else{
                    $sql = 'select * from tblKlanten where KlantNr LIKE ?';
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("i",$knr);
                        $knr = "%".$klantnummer."%";
                        if(!$stmt->execute()){
                            echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                        }
                        else{
                            $stmt->bind_result($klantnr, $klantnaam, $klantfamilienaam, $klantemail, $klantgsm, $klantpaswoord, $postid);
                            while($stmt->fetch()){
                                echo '<br><br><table border="2" width=100%>
                            <tr><th>Klantnummer</th><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th><th>Paswoord</th><th>Postcode</th><th>Wijzigen</th></tr>
                            <tr><td>'.$klantnr.'</td><td>'.$klantnaam.'</td><td>'.$klantfamilienaam.'</td><td>'.$klantemail.'</td><td>'.$klantgsm.'</td><td>'.$klantpaswoord.'</td><td>'.$postid.'</td><td><a href="wijzigk.php">Wijzig</a></tr>
                            </table>';
                            $_SESSION["id"] = $klantnr;
                            }
                        }
                        $stmt->close();
                    }
                    else{
                        echo 'Er zit een fout in de query: '.$mysqli->error;
                    }
                }                
            }
            else if(isset($_POST["naam"]) && $_POST["naam"] != ""){
                    $naam = $_POST["naam"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "select * from tblKlanten where KlantNaam LIKE ?";
                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("s",$nm);
                            $nm = "%".$naam."%";
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                $stmt->bind_result($klantnr, $klantnaam, $klantfamilienaam, $klantemail, $klantgsm, $klantpaswoord, $postid);
                                while($stmt->fetch()){
                                    echo '<br><br><table border="2" width=100%>
                            <tr><th>Klantnummer</th><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th><th>Paswoord</th><th>Postcode</th><th>Wijzigen</th></tr>
                            <tr><td>'.$klantnr.'</td><td>'.$klantnaam.'</td><td>'.$klantfamilienaam.'</td><td>'.$klantemail.'</td><td>'.$klantgsm.'</td><td>'.$klantpaswoord.'</td><td>'.$postid.'</td><td><a href="wijzigk.php">Wijzig</a></tr>
                            </table>';
                            $_SESSION["id"] = $klantnr;
                                }
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["familienaam"]) && $_POST["familienaam"] != ""){
                    $familienaam = $_POST["familienaam"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "select * from tblKlanten where KlantFamilienaam LIKE ?";
                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("s",$fnm);
                            $fnm = "%".$familienaam."%";
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                $stmt->bind_result($klantnr, $klantnaam, $klantfamilienaam, $klantemail, $klantgsm, $klantpaswoord, $postid);
                                while($stmt->fetch()){
                                    echo '<br><br><table border="2" width=100%>
                            <tr><th>Klantnummer</th><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th><th>Paswoord</th><th>Postcode</th><th>Wijzigen</th></tr>
                            <tr><td>'.$klantnr.'</td><td>'.$klantnaam.'</td><td>'.$klantfamilienaam.'</td><td>'.$klantemail.'</td><td>'.$klantgsm.'</td><td>'.$klantpaswoord.'</td><td>'.$postid.'</td><td><a href="wijzigk.php">Wijzig</a></tr>
                            </table>';
                            $_SESSION["id"] = $klantnr;
                                }
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["email"]) && $_POST["email"] != ""){
                    $mail = $_POST["email"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "select * from tblKlanten where KlantEmail LIKE ?";
                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("s",$m);
                            $m = "%".$mail."%";
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                $stmt->bind_result($klantnr, $klantnaam, $klantfamilienaam, $klantemail, $klantgsm, $klantpaswoord, $postid);
                                while($stmt->fetch()){
                                    echo '<br><br><table border="2" width=100%>
                            <tr><th>Klantnummer</th><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th><th>Paswoord</th><th>Postcode</th><th>Wijzigen</th></tr>
                            <tr><td>'.$klantnr.'</td><td>'.$klantnaam.'</td><td>'.$klantfamilienaam.'</td><td>'.$klantemail.'</td><td>'.$klantgsm.'</td><td>'.$klantpaswoord.'</td><td>'.$postid.'</td><td><a href="wijzigk.php">Wijzig</a></tr>
                            </table>';
                            $_SESSION["id"] = $klantnr;
                                }
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["gsm"]) && $_POST["gsm"] != ""){
                    $gsm = $_POST["gsm"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "select * from tblKlanten where KlantGSM LIKE ?";
                        if($stmt = $mysqli->prepare($sql)){
                            $stmt->bind_param("i",$g);
                            $g = "%".$gsm."%";
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                                $stmt->bind_result($klantnr, $klantnaam, $klantfamilienaam, $klantemail, $klantgsm, $klantpaswoord, $postid);
                                while($stmt->fetch()){
                                    echo '<br><br><table border="2" width=100%>
                            <tr><th>Klantnummer</th><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th><th>Paswoord</th><th>Postcode</th><th>Wijzigen</th></tr>
                            <tr><td>'.$klantnr.'</td><td>'.$klantnaam.'</td><td>'.$klantfamilienaam.'</td><td>'.$klantemail.'</td><td>'.$klantgsm.'</td><td>'.$klantpaswoord.'</td><td>'.$postid.'</td><td><a href="wijzigk.php">Wijzig</a></tr>
                            </table>';
                            $_SESSION["id"] = $klantnr;
                                }
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
        }
                        
?>
                       

<?php
        if(isset($_POST["verzenden2"])){
            if(isset($_POST["id"]) && $_POST["id"] != ""){
                $id = $_POST["id"];
                $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                if(mysqli_connect_errno()){
                    trigger_error('Fout bij de verbinding: '.$mysqli->error);
                }
                else{
                    $sql = 'select ProductId, ProductNaam, ProductOmschrijving, ProductPrijs from tblProducten where ProductId LIKE ?';
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("i",$nr);
                        $nr = "%".$id."%";
                        if(!$stmt->execute()){
                            echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                        }
                        else{
                            $stmt->bind_result($productnr, $productnaam, $productomschrijving, $productprijs);
                            while($stmt->fetch()){
                                echo '<br> <br><table border="2" width=100%>
                           <tr><th>Productnummer</th><th>Productnaam</th><th>Productomschrijving</th><th>Productprijs</th><th>Wijzigen</th></tr>
                           <tr><td>'.$productnr.'</td><td>'.$productnaam.'</td><td>'.$productomschrijving.'</td><td>'.$productprijs.'</td><td><a href="wijzigp.php">Wijzigen</a></td></tr>
                           </table>';
                                $_SESSION["id"] = $_POST["id"];
                            }
                        }
                        $stmt->close();
                    }
                    else{
                        echo 'Er zit een fout in de query: '.$mysqli->error;
                    }
                }                
            }
            else if(isset($_POST["naam"]) && $_POST["naam"] != ""){
                $naam = $_POST["naam"];
                $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                if(mysqli_connect_errno()){
                    trigger_error('Fout bij de verbinding: '.$mysqli->error);
                }
                else{
                    $sql = "select ProductId, ProductNaam, ProductOmschrijving, ProductPrijs from tblProducten where ProductNaam LIKE ?";
                    if($stmt = $mysqli->prepare($sql)){
                        $stmt->bind_param("s",$nm);
                        $nm = "%".$naam."%";
                        if(!$stmt->execute()){
                            echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                        }
                        else{
                            $stmt->bind_result($productnr, $productnaam, $productomschrijving, $productprijs);
                            while($stmt->fetch()){
                                echo '<br><br><table border="2" width=100%>
                           <tr><th>Productnummer</th><th>Productnaam</th><th>Productomschrijving</th><th>Productprijs</th><th>Wijzigen</th></tr>
                           <tr><td>'.$productnr.'</td><td>'.$productnaam.'</td><td>'.$productomschrijving.'</td><td>'.$productprijs.'</td><td><a href="wijzigp.php">Wijzigen</a></td></tr>
                           </table>';
                                $_SESSION["id"] = $_POST["id"];
                            }
                        }
                        $stmt->close();
                    }
                    else{
                        echo 'Er zit een fout in de query: '.$mysqli->error;
                    }
                }
            }
        }
?>
                        </div>
                   </div>
              </div>
      
    </section>
             
<div></div>
    <div></div>
    
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