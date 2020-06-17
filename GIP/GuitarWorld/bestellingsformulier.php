<?php session_start();

$bestellingsid = 0;
$y = 0;

error_reporting (E_ALL ^ E_NOTICE);

if(isset($_POST['bevestig'])){

$mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno())
        {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }else
        {
            $sql = "INSERT INTO tblbestellingen (KlantId, datum, Adres, huisnummer, postcode ) VALUES (?,?,?,?,?)";
            if($stmt= $mysqli->prepare($sql))
            {
                $stmt->bind_param('issii',$klant,$datum,$adres, $huisnummer, $postcode);
                $klant = $_SESSION["id"];
                $datum = date("Y-m-d");
                $adres=$mysqli->real_escape_string($_POST["straat"]);
                $huisnummer= $_POST["huisnummer"];
                $postcode= $_POST["postcode"];

                if(!$stmt->execute())
                {
                    echo 'het uitvoeren van de query is mislukt:';
                }
                $stmt->close();
            }
            else
            {
                echo 'Er zit een fout in de query';
            }
        }
    
    
    
    
    
    $mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno())
        {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }else
        {
            $sql = "SELECT bestellingsId FROM tblbestellingen WHERE datum LIKE ? AND KlantId LIKE ?";
            if($stmt = $mysqli->prepare($sql))
            {
                $stmt->bind_param("si",$datum, $klant);
                $datum = date("Y-m-d");
                $klant = $_SESSION["id"];
                if(!$stmt->execute())
                {
                    echo 'het uitvoeren van de query is mislukt:'.$stmt->error.'in query: '.$sql.'<br>';
                }else
                {
                    $stmt->bind_result($bid);
                    while($stmt->fetch())
                    {
                        $bestellingsid = $bid;
                    }
                }
                $stmt->close();
            }else
            {
                echo 'Er zit een fout in de query'.$mysqli->error.'<br>';
            }
        }
    
    
    
    
    $mysqli= new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno())
        {
            trigger_error('Fout bij verbinding: '.$mysqli->error);
        }else
        {
            $sql = "INSERT INTO tblbestellingenperorder (bestellingsId, productId) VALUES (?,?)";
            if($stmt= $mysqli->prepare($sql))
            {
                $stmt->bind_param('ii',$b,$p);
                $b = $bestellingsid;
                $p = $_SESSION["koopwaren"][$y];

                if(!$stmt->execute())
                {
                    echo 'het uitvoeren van de query is mislukt:';
                }
                $stmt->close();
            }
            else
            {
                echo 'Er zit een fout in de query';
            }
        }
    
    header("location:factuur.php");
    
}





?>

 <style type="text/css">
    .fout {
	color: #F00;
}
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <style type=”text/css” >
.table {border:10px solid red; }
    </style>

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
    
    
    
<?php
    
      $mysqli = new MySQLi ("localhost","root","","guitarworld");
        if(mysqli_connect_errno()){trigger_error('Fout bij de verbinding:'.$mysqli->error);}
        else{
            $sql = "SELECT  klantStraat, KlantHuisnummer,  PCode, Gemeente FROM tblklanten k JOIN tblgemeente g ON k.PostcodeId = g.PostcodeId WHERE KlantNr LIKE ?";
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $id);
                $id = $_SESSION["id"];
              
            
                 if(!$stmt->execute()){

                     echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$sql;
                }
                else{
                     $stmt->bind_result($klantStraat, $KlantHuisnummer, $PCode, $Gemeente);
                    while($stmt->fetch()){
                    ?>
                    
                     <form action="#" name="bevestiging" id="bevestiging" method="post">
                                <label>Straat: </label>
                                 <input type="text" class="form-control" name="straat" id="straat" value="<?php echo $klantStraat; ?>" required>
                                 <label id="straatVerplicht" class="fout"></label>
                                
                                <label>Huisnummer: </label>
                                 <input type="huisnummer" class="form-control" name="huisnummer" id="huisnummer" value="<?php echo $KlantHuisnummer; ?>" required>
                                 <label id="huisnummerVerplicht" class="fout"></label>
                                
                                <label>Postcode: </label>
                                 <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $PCode; ?>" required>
                                 <label id="postcodeVerplicht" class="fout"></label>
                                
                                <label>Gemeente: </label>
                                 <input type="text" class="form-control" name="gemeente" id="gemeente" value="<?php echo $Gemeente; ?>" required>
                                 <label id="gemeenteVerplicht" class="fout"></label>
                                <br>
                                <input type="submit" name="bevestig" class="section-btn" id="bevestig" value="Bevestig" >
                            </form>
    
    
    <?php
                    }
                    
                    
                    
            }
            }
        }
    
?>
    
    
    
    
    
    
    
                           
                            


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
                          //echo 'Het uitvoeren van de query is mislukt: '.$stmt->error.' in query: '.$querrie;
                      }
                      else{
                          $stmt->bind_result($id, $productnaam, $prijs);
                           ?><table width=100% class="table"><?php
                          while($stmt->fetch()){
                            ?> <tr><td><?php echo $productnaam."</br>"; ?></td></tr><tr><td><?php echo $prijs; ?>€</td></tr>
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
    ?>
                            
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