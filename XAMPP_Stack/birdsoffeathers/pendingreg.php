<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");
    $successmessage = '';
    $error = '';
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $decisionid = mysqli_real_escape_string($db,$_POST['decisionid']);
            $decision = mysqli_real_escape_string($db,$_POST['decision']); 
            $institutionid = mysqli_real_escape_string($db,$_POST['institutionid']); 
            if ($institutionid === ""){
                if ($decision === "Approve"){
                 throw new Exception("InstitutionID cannot be blank");
                }
                else{
                   $institutionid = "NULL";
                }
            }

            $sqlDecision = "CALL `birdsoffeathers`.`sp_update_registrationrequest`('$decision',$decisionid,$institutionid);";
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlDecision);
            
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }
            $db->next_result();
            //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //$active = $row['active'];
            
            $count = mysqli_num_rows($result);
            
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
                $row =  $result->fetch_object();
                //session_register("myusername");
                $to = $row->v_emailaddress;
                $to = 'lithathampan@gmail.com'; //debug overwrite
                $subject = "Registration ".($decision == 'Approve' ? ' Approved ' : ' Rejected ');
                $mailContent = 'Dear '.$row->v_fname.', 
                <br/>Thank you for your patience. Your Registration Request to Maggotty Alumni Association has been '.($decision == 'Approve' ? ' Approved ' : ' Rejected ').'.';
                if($decision == 'Approve'){
                  $mailContent .= '<br/>Please feel free to use your requested username and password for logging in.';
                }
                else{
                  $mailContent .= '<br/>The information provided during the registration did not match the institution records. Please reply to this email if there are any concern.';
                }
                
                $mailContent .= '<br/><br/>Regards,
                <br/>Maggotty Alumni Association';
                //send email
                $success = mail($to,$subject,$mailContent,$emailheader);
                //echo 'Wait for your Email'.$passcode;
                if (!$success) {
                    throw new Exception(error_get_last()['message']);
                }
                else{
                    $successmessage = 'Database Updated Successfully';
                }
               
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
   <!-- <div class="row" style="margin-top:10px;">
        <div class="medium-12"> -->
        <div class="row">
        <div class="small-12 columns" align="center">
        <span class="input-group-error">
        <span class="input-group-cell"></span>
        <span class="input-group-cell"><span>Pending Registration</span></span>
        </div>
        </div>
        <div class="small-12" align="center" style="overflow-x:auto;">

        <table style="table-layout: fixed;display: block;overflow:scroll;">
        
        
        <?php
        $ci=1;
        $sci=1;
        $sqlPending = "CALL `birdsoffeathers`.`sp_get_pendingregistrations`();";
        $pending = $db->query($sqlPending); 
        if($pending === FALSE){
            $error = $db->error;
        }
        $db->next_result();
        echo '<thead><tr>
        <th>Institution Member ID</th>
        <th>Name</th>
        <th>Member Type</th>
        <th>Request Date</th>
        <th>Date of Birth</th>
        <th>Batch Year Month</th>
        <th>Departing Year Month</th>
        <th>Role Type</th>
        <th>Decision</th>
      </tr></thead><tbody>';
      while($objReg = $pending->fetch_object()) {
          echo '<tr><form action="" method="post">';
         // echo '<td>'.$objCat->RegistrationID.'</td>';
          echo '<td><input type="text" id="right-label" name="institutionid" value="'.$objReg->InstitutionMemberID.'"></td>';
   
          echo '<td>'.$objReg->FirstName.' '.$objReg->LastName.'</td>';
          echo '<td>'.$objReg->MemberType.'</td>';
          echo '<td>'.$objReg->RequestDate.'</td>';
          echo '<td>'.$objReg->DateofBirth.'</td>';
          echo '<td>'.$objReg->JoiningYearMonth.'</td>';
          echo '<td>'.$objReg->EndYearMonth.'</td>';
          echo '<td>'.$objReg->RoleType.'</td>';
          echo '<td>
          <input type="hidden" name="decisionid" value="'.$objReg->RegistrationID.'" />
          <input type="submit" name="decision" value="Approve" class="labelbutton"/>';
            echo '
            <input type="hidden" name="decisionid" value="'.$objReg->RegistrationID.'" /> 
            <input type="submit" name="decision" value="Reject" class="labelbutton"/>
            </td>';
          //echo '<td><a class=\'btn btn-primary btn-lg\'  href=\'send.php?name=".$row[\'name\']."\'>Reject</a></td>';
          echo '</form></tr>';
      }
    ?>
      </tbody>
    </table>
  </div>
  <div class="row">
                    <div class="small-12 columns" align="center">
                    <a href="lookuprecords.php" target="InstitutionSearch" >Lookup Institution Records</a>
                    </div>
        </div>
    <div class="row">
              <div class="small-12 columns" align="center">
                    <label for="right-label" class="right inline"><?php echo $successmessage; ?></label>
                    </div>

              </div>
    <div class="row">
        <div class="small-12 columns" align="center">
        <span class="input-group-error">
        <span class="input-group-cell"></span>
        <span class="input-group-cell"><span class="error-message"><?php echo $error; ?></span></span>
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
  </body>
</html>