<?php
    include("session.php");
    include("topbardata.php");
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $paycurrency = mysqli_real_escape_string($db,$_POST['paycurrency']);
            $payamount = mysqli_real_escape_string($db,$_POST['payamount']); 
            $userid = $_SESSION['login_user'];
            $sqlDonate= "CALL `birdsoffeathers`.`sp_add_donation`($userid,$payamount,'$paycurrency');";
            $result = $db->query($sqlDonate);
            //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //$active = $row['active'];
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }
            $count = mysqli_num_rows($result);
            $row =  $result->fetch_object();
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
                //session_register("myusername");
                $_SESSION['donationid'] = $row->DonationID;
               // $_SESSION['payamount'] = $payamount;
                //$_SESSION['paycurrency'] = $paycurrency;
                header("location: payment.php");
            }else {
                throw new Exception("System Error, Please contact administrator");
            }
        }   

    }
    catch(Exception $e)
    {
    $error = $e->getMessage();
    }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Maggotty Alumni Association</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/foundation-icons.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation" background="white">
      <ul class="title-area">
        <li class="name">
        <h1><a href="index.php"><i class="fi-home large"></i> Maggotty Alumni Association US Northern Region</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          
        <?php
          topbarul('donation');
          ?>
        </ul>
      </section>
    </nav>
    <form method="POST" action="" style="margin-top:30px;">
        <div class="row" style="margin-top:10px;">
            <div class="small-12">
                
            </div>
        </div>
        <div class="row" align="center">
                <div class="small-4 columns">
                <label for="paycurrencyid" class="right inline">Currency</label>
                </div>
                <div class="small-8 columns">
                <select id="paycurrencyid" name='paycurrency'>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="JPY">JPY</option>
                </select>
                </div>
            </div>
        <div class="row" align="center">
        <div class="small-4 columns">
            <label for="payamountid" class="right inline">Donation Amount</label>
        </div>
        <div class="small-8 columns">
            <input id="payamountid" type="number" min="10.00" step="1" max="2500" value="10.00" name="payamount" />
        </div>
        </div>
          
        <div class="row" align="center">
        <div class="small-4 columns">
            <label for="right-label" class="right inline"></label>
        </div>
        </div>
        <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <input type="submit" id="right-label" value="Submit" class="labelbutton">
                    <input type="reset" id="right-label" value="Reset" class="labelbutton">
                    </div>
        </div>
    </form>
      <div class="row" style="margin-top:10px;">
      <div class="small-12">

        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;">&copy; Birds of Feathers. All Rights Reserved.</p>
        </footer>

      </div>
    </div>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>