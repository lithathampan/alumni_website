<?php
    include("config.php");
    include("topbardata.php");
    session_start();
    $successmessage = '';
    $error = '';
    function verifyentry($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid characters in input");
        }
    }
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $myuseremail = mysqli_real_escape_string($db,$_POST['useremail']);
            verifyentry($myuseremail);
            $sqlEmailCheck= "CALL `birdsoffeathers`.`sp_email_check`('$myuseremail');";
            $result = $db->query($sqlEmailCheck);  
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }         
            $count = mysqli_num_rows($result);
            
            // If result matched $myuseremail table row must be 1 row                
            if($count == 1) {
                $row =  $result->fetch_object();
                //session_register("myusername");
                $passcode = $row->ForgotPasswordCode;
                //send reset password email
                $resetPassLink = 'http://192.168.1.171/birdsoffeathers/resetpassword.php?fp_code='.$passcode;//192.168.1.171
                $to = $myuseremail;
                $to = 'lithathampan@gmail.com'; //debug overwrite
                $subject = "Password Update Request";
                $mailContent = 'Dear '.$row->NameofUser.', 
                <br/>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
                <br/>To reset your password, visit the following link in next 3 days: <a href="'.$resetPassLink.'">'.$resetPassLink.'</a>
                <br/><br/>Regards,
                <br/>Maggotty Alumni Association';
                //send email
                $success = mail($to,$subject,$mailContent,$emailheader);
                //echo 'Wait for your Email'.$passcode;
                if (!$success) {
                    throw new Exception(error_get_last()['message']);
                }
                else{
                    $successmessage = 'A password reset link has been sent to your registered email';
                }
            }else {
                throw new Exception("Unknown Exception Occured");
            }
        }   
    }
    catch(Exception $e)
    {
    $error = $e->getMessage();
    }
?>
<html>
   <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Maggotty Alumni Association</title>
        <link rel="stylesheet" href="css/foundation.css" /> 
        <link rel="stylesheet" href="css/app.css" />
        <link rel="stylesheet" href="css/foundation-icons.css" />
        <script src="js/vendor/modernizr.js"></script>      
   </head>
   
   <body>
   <nav class="top-bar" data-topbar role="navigation">
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
    <form method="POST" action="" style="margin-top:30px;">
        <div class="row">
            <div class="small-8">

                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Enter your Registered Email</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="email" id="right-label" placeholder="yourregisterdemail@domain.com" name="useremail">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <input type="submit" id="right-label" value="Send" class="labelbutton">
                    <input type="reset" id="right-label" value="Reset" class="labelbutton">
                    </div>
                </div>
                <br>
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
        </div>
        </form>

        <div class="row" style="margin-top:10px;">
        <div class="small-12">

            <footer>
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