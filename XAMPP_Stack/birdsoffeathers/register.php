<?php
    include("config.php");
    include("topbardata.php");
    session_start();
    $successmessage = '';
    $error = '';
    function verifyunamepwd($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if(preg_match('/[^a-zA-Z_\-0-9\@]/i', $string)) 
        {
            throw new Exception("Invalid special characters(Only @ and _ allowed).");
        } 
        if(strlen($string) < 8){
            throw new Exception("Username and Password should be at least 8 character.");
        }
    }
    function verifyemail($string) {
        // function to verify only alphanumeric , _ and @ characters are allowed in username and password
        if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid Email Address Provided");
        }
    }
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $membertype = mysqli_real_escape_string($db,$_POST['membertype']);
            $roletype = mysqli_real_escape_string($db,$_POST['roletype']); 
            $fname = mysqli_real_escape_string($db,$_POST['fname']);
            $lname = mysqli_real_escape_string($db,$_POST['lname']); 
            $dateofbirth = mysqli_real_escape_string($db,$_POST['dateofbirth']);
            $useremail = mysqli_real_escape_string($db,$_POST['useremail']); 
            $institutionid = mysqli_real_escape_string($db,$_POST['institutionid']);
            $branchname = mysqli_real_escape_string($db,$_POST['branchname']); 
            $startmonth = mysqli_real_escape_string($db,$_POST['startmonth']);
            $endmonth = mysqli_real_escape_string($db,$_POST['endmonth']); 
            $requsername = mysqli_real_escape_string($db,$_POST['username']);
            $reqpassword = mysqli_real_escape_string($db,$_POST['password']); 
            verifyunamepwd($requsername);
            verifyunamepwd($reqpassword);
            verifyemail($useremail);
            $md5password = md5($reqpassword);
            if ($institutionid === ""){
              $institutionid = "NULL";
            }
            if ($startmonth === ""){
              $startmonth = "NULL";
            }
            if ($endmonth === ""){
              $endmonth = "NULL";
            }
            //$myusername = $_POST['username'];
            //$mypassword = $_POST['password'];
            $sqlRegister = "CALL `birdsoffeathers`.`sp_add_registrationrequest`('$membertype','$roletype','$fname','$lname','$dateofbirth','$useremail',$institutionid,'$branchname',$startmonth,$endmonth,'$requsername','$md5password');";
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlRegister);
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
                $to = $useremail;
                $to = 'lithathampan@gmail.com'; //debug overwrite
                $subject = "Registration Request";
                $mailContent = 'Dear '.$fname.', 
                <br/>Thank you for submitting Registration Request to Maggotty Alumni Association. Your registration is being validated in the system
                <br/>It would take between 1-3 business days to proces the application. Please wait for an email from this email id
                <br/><br/>Regards,
                <br/>Maggotty Alumni Association';
                //send email
                $success = mail($to,$subject,$mailContent,$emailheader);
                //echo 'Wait for your Email'.$passcode;
                if (!$success) {
                    throw new Exception(error_get_last()['message']);
                }
                else{
                    $successmessage = 'Registration Request Submitted. Please wait for your approval email.';
                }

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
        <link rel="stylesheet" href="css/foundation-datepicker.css" />
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

          topbarul('register');
          ?>
        </ul>
      </section>
    </nav>
    <form method="POST" action="" style="margin-top:30px;">
    <!--Render Registration Form with MemberType,
Name, InstitutionID ,DateofBirth, BranchName,
StartYearMonth,EndYearMonth ,EmailID,
RequestedUserName, RequestedPassword;-->
      <div class="row">
        <div class="small-8">
        <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Member Type</label>
            </div>
            <div class="small-8 columns">
            <select id="right-label" name='membertype'>
                <option value="Alumni">Alumni</option>
                <option value="Staff">Staff</option>
                <option value="Student">Student</option>
            </select>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Role Type</label>
            </div>
            <div class="small-8 columns">
            <select id="right-label" name='roletype'>
                <option value="Member">Member</option>
                <option value="Admin">Administrator</option>
                <option value="SuperUser">SuperUser</option>
            </select>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">First Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="YourFirstName" name="fname" value ="<?php if($error <> ""){ echo $_POST['fname'];}?>">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Last Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="YourLastName" name="lname" value ="<?php if($error <> ""){ echo $_POST['lname'];}?>">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Date of Birth</label>
            </div>
            <div class="small-8 columns">
            <input type="text" class="span2" id="dp1" name="dateofbirth" value ="<?php if($error <> ""){ echo $_POST['dateofbirth'];}?>">            
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">E-Mail</label>
            </div>
            <div class="small-8 columns">
              <input type="email" id="right-label" placeholder="youremail@domain.com" name="useremail" value ="<?php if($error <> ""){ echo $_POST['useremail'];}?>">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">InstitutionID(BadgeID)</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="right-label" placeholder="1987654" name="institutionid" value ="<?php if($error <> ""){ echo $_POST['insitutionid'];}?>"> 
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Course of Study(Major)</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Computer Science" name="branchname" value ="<?php if($error <> ""){ echo $_POST['branchname'];}?>">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Joined Month</label>
            </div>
            <div class="small-8 columns">
            <input type="text" class="span2" id="dp2" name="startmonth" value ="<?php if($error <> ""){ echo $_POST['startmonth'];}?>">             
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Departure Month</label>
            </div>
            <div class="small-8 columns">
            <input type="text" class="span2" id="dp3" name="endmonth" value ="<?php if($error <> ""){ echo $_POST['endmonth'];}?>">            
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Proposed Username</label>
            </div>
            <div class="small-8 columns">
            <span class="has-tip tip-top" data-tooltip aria-haspopup="true" title="Minimum 8 characters with only @ and _ as special characters">
              <input type="text" id="right-label"  name="username">
              </span>
            </div>
            
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Proposed Password</label>
            </div>
            <div class="small-8 columns">
            <span class="has-tip tip-top" data-tooltip aria-haspopup="true" title="Minimum 8 characters with only @ and _ as special characters">
              <input type="password" id="right-label" name="password">
              </span>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="right-label" value="Register" class="labelbutton">
              <input type="reset" id="right-label" value="Reset" class="labelbutton">
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
        <script src="js/foundation-datepicker.js"></script>
        <script>
        $(document).foundation();
        </script>
   </body>
</html>
<script>
                    $(function(){
                        $('#dp1').fdatepicker({
                            format: 'yyyy-mm-dd',
                            disableDblClickSelection: true,
                            leftArrow:'<<',
                            rightArrow:'>>',
                            closeIcon:'X',
                            closeButton: true
                        });
                        $('#dp2').fdatepicker({
                            format: 'yyyymm',
                            disableDblClickSelection: true,
                            leftArrow:'<<',
                            rightArrow:'>>',
                            closeIcon:'X',
                            closeButton: true
                        });
                        $('#dp3').fdatepicker({
                            format: 'yyyymm',
                            disableDblClickSelection: true,
                            leftArrow:'<<',
                            rightArrow:'>>',
                            closeIcon:'X',
                            closeButton: true
                        });
                    });
</script>





    

