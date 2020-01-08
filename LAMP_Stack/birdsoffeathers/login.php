<?php
    include("config.php");
    include("topbardata.php");
    session_start();
    $error='';
    function verifyentry($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if(preg_match('/[^a-zA-Z_\-0-9\@]/i', $string)) 
        {
            throw new Exception("Invalid characters in input");
        }
    }
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $myusername = mysqli_real_escape_string($db,$_POST['username']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
            verifyentry($myusername);
            verifyentry($mypassword);
            $md5password = md5($mypassword);
            //$myusername = $_POST['username'];
            //$mypassword = $_POST['password'];
            $sqlLogin = "CALL `birdsoffeathers`.`sp_login_check`('$myusername','$md5password');";
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlLogin);
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
                $_SESSION['login_user'] = $row->UserID;
                $_SESSION['login_role'] = $row->GroupName;
                header("location: index.php");
            }else {
                throw new Exception("Your Login Name or Password is invalid");
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
            topbarul('login');
          ?>
        </ul>
      </section>
    </nav>
    <form method="POST" action="" style="margin-top:30px;">
        <div class="row">
            <div class="small-8">

                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Username</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="text" id="right-label" placeholder="myusername" name="username">
                    </div>
                </div>
                <div class="row">
                    <div class="small-4 columns">
                    <label for="right-label" class="right inline">Password</label>
                    </div>
                    <div class="small-8 columns">
                    <input type="password" id="right-label" name="password">
                    </div>
                </div>

                <div class="row">
                    <div class="small-4 columns">

                    </div>
                    <div class="small-8 columns">
                    <input type="submit" id="right-label" value="Login" class="labelbutton" >
                    <input type="reset" id="right-label" value="Reset" class="labelbutton">
                    <br/>
                    <a href="forgotpassword.php">Forgot password?</a>
                    <br/>
                    <a href="register.php">Not a Member?</a>
                    </div>
                </div>
                <br>
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