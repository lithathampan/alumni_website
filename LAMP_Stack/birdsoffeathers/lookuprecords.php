<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");
    $successmessage = '';
    $error = '';
    /*try{
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
            $row =  $result->fetch_object();
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
                //session_register("myusername");
                $successmesage = 'Database Updated Successfully';
            }
        }   
    }
    catch(Exception $e)
    {
    $error = $e->getMessage();
    }*/
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
  <body background="yellow">

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
        <span class="input-group-cell"><span>Institution Records</span></span>
        </div>
        </div>
         <div class="row" align="center">
                <div class="small-4 columns">
                    <label for="searchinput class="right inline">Name</label>
                </div>
                <div class="small-8 columns">
                    <input type="text" id="searchinput" name="searchname" onkeyup="searchName()" placeholder="Enter Name">
                </div>
        </div>
        <div class="small-12" align="center" style="overflow-x:auto;">

        <table id="InstTable" style="table-layout: fixed;display: block;overflow:scroll;">
        
        
        <?php
        $ci=1;
        $sci=1;
        $sqlInst = "CALL `birdsoffeathers`.`sp_get_institutionrecords`();";
        $institutionrecs = $db->query($sqlInst);  
        if($institutionrecs === FALSE){
            $error = $db->error;
        }
        $db->next_result();
        echo '<thead><tr>
        <th>Institution Member ID</th>
        <th>Name</th>
        <th>Member Type</th>
        <th>Date of Birth</th>
        <th>Batch Year Month</th>
        <th>Departing Year Month</th>
      </tr></thead><tbody>';
      while($objRec= $institutionrecs->fetch_object()) {
          echo '<tr><form action="" method="post">';
         // echo '<td>'.$objCat->RegistrationID.'</td>';
         # InstitutionMemberID, MemberType, DateofBirth, FirstName, LastName, EndYearMonth, BranchName, JoiningYearMonth

          echo '<td>'.$objRec->InstitutionMemberID.'</td>';
   
          echo '<td>'.$objRec->FirstName.' '.$objRec->LastName.'</td>';
          echo '<td>'.$objRec->MemberType.'</td>';
          echo '<td>'.$objRec->DateofBirth.'</td>';
          echo '<td>'.$objRec->JoiningYearMonth.'</td>';
          echo '<td>'.$objRec->EndYearMonth.'</td>';
          //echo '<td><a class=\'btn btn-primary btn-lg\'  href=\'send.php?name=".$row[\'name\']."\'>Reject</a></td>';
          echo '</form></tr>';
      }
    ?>
      </tbody>
    </table>
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

<script>
function searchName() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("searchinput");
  filter = input.value.toUpperCase();
  table = document.getElementById("InstTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>