<?php
    include("session.php");
    include("topbardata.php");
    $error='';
    $successmessage='';
    try{
        if($_SERVER["REQUEST_METHOD"] != "POST") {
        
            $userid = $_SESSION['login_user'];
            if(isset($_SESSION['donationid'])){
                $donationid = $_SESSION['donationid'];
                $eventregistrationid = "NULL";
            }
            elseif(isset($_SESSION['eventregistrationid'])){
                $donationid = "NULL";
                $eventregistrationid = $_SESSION['eventregistrationid'];
            }
            else{
                throw new Exception('System Error Occured. Please re-attempt from Menu');
            }
            $sqlTrans = "CALL `birdsoffeathers`.`sp_add_online_transaction`($userid,$donationid,$eventregistrationid);";
            $trans = $db->query($sqlTrans); 
            if($trans === FALSE){
                throw new Exception($db->error);
            }
            $db->next_result();
            $count = mysqli_num_rows($trans);
            $row =  $trans->fetch_object();
            if($count == 1) {
                //session_register("myusername");
                $payamount = $row->v_amount;
                $paycurrency = $row->v_currency;
                $_SESSION['onlinetransid'] = $row->v_onlinetransid;
            // $_SESSION['payamount'] = $payamount;
                //$_SESSION['paycurrency'] = $paycurrency;
            }else {
                throw new Exception("System Error, Please contact administrator");
            }
        }
        else {
            $pstransactionid = $_POST['transactionid'];
            $onlinetransid = $_SESSION['onlinetransid'];
            $userid = $_SESSION['login_user'];
            $sqlTrans = "CALL `birdsoffeathers`.`sp_update_online_transaction`($userid,$onlinetransid,'$pstransactionid');";
            $trans = $db->query($sqlTrans); 
            if($trans === FALSE){
                throw new Exception($db->error);
            }
            $db->next_result();
            $successmessage = 'Thank you for the payment. Your PayPal Transaction Number is '.$pstransactionid.'. Please do not use refresh or back button from this page.';
        }
    }
    catch(Exception $e)
    {
        $error = $e->getMessage();
        if ($error === "") {
            $error = "Unknown Database Error";
        }
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
          topbarul('');
          ?>
        </ul>
      </section>
    </nav>

    <div class="row" style="margin-top:10px;">
          <div class="small-12">
            
          </div>
    </div>
    
   <div class="row" align="center">
        <div class="small-4 columns">
        <label for="paycurrency" class="right inline">Currency</label>
        </div>
        <div class="small-8 columns">
        <label id="paycurrency"><?php echo $paycurrency; ?></label>
                </div>
            </div>
        <div class="row" align="center">
        <div class="small-4 columns">
            <label for="payamount" class="right inline">Amount</label>
        </div>
        <div class="small-8 columns">
            <label id="payamount" ><?php echo $paycurrency=="JPY"?floor($payamount):$payamount; ?></label>
        </div>
    </div>
    <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <label for="right-label" class="right inline"><?php echo $successmessage; ?></label>
                    </div>

        </div>
          <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <span class="input-group-error">
                    <span class="input-group-cell"></span>
                    <span class="input-group-cell"><span class="error-message"><?php echo $error; ?></span></span>
                    </div>

            </div>
    <div class="row" align="center">
    <div class="small-4 columns">
        <label for="right-label" class="right inline"></label>
    </div>
    <div id="paypal-button-container" class="small-8 columns">
    </div>
    </div>
    
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
     <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production
            style: {
            size: 'responsive'
            },
            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AaL4qXdfX5uywVYxJMgabUxz_fK47yJkdOEMNbQMbU3AhHYawlKvGq8Jy5p9Odgjsj-ZCUacNoy2hT5O',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {
                //alert('"' + document.getElementById('payamount').innerHTML + '"')
                //alert('"' + document.getElementById('paycurrency').innerHTML + '"')
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: document.getElementById('payamount').innerHTML, currency: document.getElementById('paycurrency').innerHTML }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function(payment) {
                    //window.alert('Payment Complete!');
                    var tranid = payment.transactions[0].related_resources[0].sale.id;
                    var amount = document.getElementById('payamount').value;
                    var currency = document.getElementById('paycurrency').value;
                    window.alert('Payment Complete! Your Transaction Reference Number is : ' + tranid);
                    //window.location.replace('index.php?orderid=' + orderid);
                    $.post('payment.php', { transactionid: tranid });
                    window.location.replace("index.php");
                    //window.location.href = 'orderconfirmed.php?transactionID='+tranid;
                     //document.querySelector('#confirmmessage').innerText = payment.transactions[0].related_resources[0].sale.id;
                    //payment.transactions[0].related_resources[0].sale.id
                });
            }

        }, '#paypal-button-container');

    </script>
  </body>
</html>