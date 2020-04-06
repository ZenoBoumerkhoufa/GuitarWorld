<?php session_start(); ?>
<?php
                        if(isset($_SESSION["id"])){
                        $id = $_SESSION["id"];
                        
        if(isset($_POST["verzenden"])){
            if(isset($_POST["naam"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $naam = $_POST["invoer"];
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
            else if(isset($_POST["familienaam"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $familienaam = $_POST["invoer"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblKlanten SET KlantFamilienaam = ? WHERE KlantNr = ".$id;
                       
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
            else if(isset($_POST["email"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $mail = $_POST["invoer"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblKlanten SET KlantEmail= ? WHERE KlantNr = ".$id;
                        if($stmt = $mysqli->prepare($sql)){
                               $stmt->bind_param("s", $kf);
                            $kf = $_POST["invoer"];
                            if(!$stmt->execute()){
                                echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                            }
                            else{
                              header("location:admin.php");
                            }
                            $stmt->close();
                        }
                        else{
                            echo 'Er zit een fout in de query: '.$mysqli->error;
                        }
                    }
                }
            else if(isset($_POST["gsm"]) && isset($_POST["invoer"]) && $_POST["invoer"] != ""){
                    $gsm = $_POST["invoer"];
                    $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                    if(mysqli_connect_errno()){
                        trigger_error('Fout bij de verbinding: '.$mysqli->error);
                    }
                    else{
                        $sql = "UPDATE tblKlanten SET Klantgsm=? WHERE KlantNr = ".$id;
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
                            <h2>Klant wijzigen</h2>
                            <span class="line-bar">...</span>
                        </div>
                        
                        <!-- VALUE'S -->                        
                        
<?php
        if(isset($_SESSION["id"]) && $_SESSION["id"] != ""){
            $nr = $_SESSION["id"];
                        
                $mysqli = new MYSQLi ("localhost","root","","guitarworld");
                if(mysqli_connect_errno()){
                    trigger_error('Fout bij de verbinding: '.$mysqli->error);
                }
                else{
                    $sql = "SELECT KlantNaam, KlantFamilienaam, KlantEmail, KlantGSM FROM tblKlanten WHERE KlantNr = ". $nr ;
                    if($stmt = $mysqli->prepare($sql)){
                        if(!$stmt->execute()){
                            echo "Het uitvoeren van de query is mislukt: ".$stmt->error." in de query: ".$sql;
                        }
                        else{
                            $stmt->bind_result($naam, $famnaam, $mail, $gsm);
                            $stmt->fetch();
                            ?>
                        
                        
                        <table border="2" width=100%>
                            <tr><th>Naam</th><th>Familienaam</th><th>Email</th><th>GSM</th></tr>
                            <tr><td><?php echo $naam; ?></td><td><?php echo $famnaam; ?></td><td><?php echo $mail; ?></td><td><?php echo $gsm; ?></td></tr>
                        </table>
                        
                        
                        
                        
                        
 <form id="form1" name="form1" method="post">
     <table>
         <tr>
                               <td>
                                   
                                    &nbsp;
                                   
                                   </td>
                               </tr>
         <tr><td>
Te wijzigen:
         
 <input type="radio" name="naam" id="naam" />  &nbsp;  Naam     &nbsp;    &nbsp;    &nbsp;    &nbsp;    &nbsp;
         
 <input type="radio" name="familienaam" id="familienaam"/> &nbsp;   Familienaam &nbsp;    &nbsp;    &nbsp;    &nbsp;    &nbsp;
         
 <input type="radio" name="email" id="email"/>  &nbsp;  Email &nbsp;    &nbsp;    &nbsp;    &nbsp;    &nbsp;
         
 <input type="radio" name="gsm" id="gsm"/>  &nbsp;  GSM &nbsp;    &nbsp;    &nbsp;    &nbsp;    &nbsp;
         </td></tr>
         <tr>
                               <td>
                                   
                                    &nbsp;
                                   
                                   </td>
                               </tr>
         <tr><td><input type="text" name="invoer" id="invoer" /></td></tr>
         
         <tr>
                               <td>
                                   
                                    &nbsp;
                                   
                                   </td>
                               </tr>
         
         <tr><td>
 <input type="submit" name="verzenden" id="verzenden" value="wijzigen" />
             
 <input type="reset" name="wissen" id="wissen" value="wissen" />
         </td></tr>
     </table>
</form> 
                        
                        
                        <?php
                        }
                        $stmt->close();
                    }
                    else{
                        echo "Er zit een fout in de query: ".$mysqli->error;
                    }
                }
        }
?>
                        
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