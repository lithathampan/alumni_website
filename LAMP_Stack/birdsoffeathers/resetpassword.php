<?php
    include("config.php");
    include("topbardata.php");
    session_start();
    $successmessage = '';
    $error = '';
    function verifyentry($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if(preg_match('/[^a-zA-Z_\-0-9\@]/i', $string)) 
        {
            throw new Exception("Invalid special characters(Only @ and _ allowed).");
        } 
        if(strlen($string) < 8){
            throw new Exception("Password should be at least 8 character.");
        }
    }
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $newpassword = mysqli_real_escape_string($db,$_POST['newpassword']);
            $confpassword = mysqli_real_escape_string($db,$_POST['confpassword']); 
            $fp_code = $_POST['fp_code'];
            verifyentry($newpassword);
            verifyentry($confpassword);
            if ($newpassword !== $confpassword){
                throw new Exception("Passwords should match");
            }
            $md5password = md5($newpassword);
            //$myusername = $_POST['username'];
            //$mypassword = $_POST['password'];
            $sqlReset = "CALL `birdsoffeathers`.`sp_reset_password`('$fp_code','$md5password');";
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlReset);
            
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }
            //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //$active = $row['active'];
            
            $count = mysqli_num_rows($result);
            $row =  $result->fetch_object();
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
                //session_register("myusername");
                $successmessage = 'Password Reset Successfully . Please Login with new password';

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
        <link rel="stylesheet" href="css/foundation-icons.css" />
        <link rel="stylesheet" href="css/app.css" />
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
                    <label for="right-label" class="right inline">Enter New Password</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="password" id="right-label" placeholder="New Password" name="newpassword">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Re-Enter New Password</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="password" id="right-label" placeholder="Confirm Password"  name="confpassword">
                    </div>
                </div>

                <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <input type="hidden" name="fp_code" value="<?php echo $_REQUEST['fp_code']; ?>"/>
                    <input type="submit" id="right-label" value="Submit" class="labelbutton">
                    <input type="reset" id="right-label" value="Clear" class="labelbutton">
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