<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");
    $successmessage = '';
    $error = '';
    function has_dupes($array) {
        // streamline per @Felix
        return count($array) !== count(array_unique($array));
     }
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $pquestion = mysqli_real_escape_string($db,$_POST['pquestion']);
            $pollenddate = mysqli_real_escape_string($db,$_POST['pollenddate']); 
            $activeflag = ($_POST['chkpublish'] == "on") ?"Active":"Inactive";
            $activeflag = "Active";
            $pollchoicearr = $_POST['pollchoicearr']; 
            foreach ($pollchoicearr as &$value) {
                $value = mysqli_real_escape_string($db,$value);
            }
            if(has_dupes($pollchoicearr)){
                throw new Exception("Choices must be unique");
            }
            //$myusername = $_POST['username'];
            //$mypassword = $_POST['password'];
            $sqlAddPoll = "CALL `birdsoffeathers`.`sp_add_poll`('$pquestion','$pollenddate','$activeflag');";
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlAddPoll);
            //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            //$active = $row['active'];
                       
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }
            
            $db->next_result();
            $count = mysqli_num_rows($result);
            $row =  $result->fetch_object();
            // If result matched $myusername and $mypassword, table row must be 1 row
                
            if($count == 1) {
                //session_register("myusername");
                $pollid = $row->pollid;
                foreach ($pollchoicearr as $choicedesc) {
                    $sqlAddPollChoice = "CALL `birdsoffeathers`.`sp_add_pollchoice`($pollid,'$choicedesc');";
                    $result = $db->query($sqlAddPollChoice);
                    if($result === FALSE)
                    {
                        throw new Exception($db->error);
                    }                    
                    $db->next_result();
                }
                $successmessage = 'Poll submitted to the system.';
               
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
            <div class="small-4 columns">
            </div>
            <div class="small-8 columns">
            </div>
          </div>
          
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Poll Question</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Poll Question Description" name="pquestion" required/>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Poll Ending Date</label>
            </div>
            <div class="small-8 columns">
            <input type="text" class="span2" id="dp1" placeholder="YYYY-MM-DD" name="pollenddate" required>            
            </div>
          </div>
          
          
          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
                <input type="button" class="labelbutton" value="Add Choice" onClick="addRow('dataTable')" /> 
                <input type="button" class="labelbutton" value="Remove Choice" onClick="deleteRow('dataTable')" />
              </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
            </div>
            <div class="small-8 columns">
            </div>
          </div>
          
          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns" align="center" style="overflow-x:auto;">
            <table id="dataTable" style="table-layout:fixed;overflow:scroll;">
                <tbody>
                <tr>
                <td><input type="text" id="pollchoiceid" name="pollchoicearr[]" placeholder= 'Choice Description' required></td>
                 </tr>
                 <tr>
                <td><input type="text" id="pollchoiceid" name="pollchoicearr[]" placeholder= 'Choice Description' required></td>
                 </tr>
                </tbody>
                </table>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
            </div>
            <div class="small-8 columns">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Publish Now</label>
            </div>
            <div class="small-8 columns">
            <span class="has-tip tip-top" data-tooltip aria-haspopup="true" title="Polls are currently implemented as auto-publish">
            <input type="checkbox" name="chkpublish" checked="checked" readonly/>
            </span>
            <input type="submit" class="labelbutton" value="Add Poll" /> 
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
                        var d = new Date();
                        $('#dp1').fdatepicker({
                            format: 'yyyy-mm-dd',
                            startDate: d,
                            disableDblClickSelection: true,
                            leftArrow:'<<',
                            rightArrow:'>>',
                            closeIcon:'X',
                            closeButton: true
                        });
                    });

                    function addRow(tableID) {
                        var table = document.getElementById(tableID);
                        var rowCount = table.rows.length;
                        if(rowCount < 5){                            // limit the user from creating fields more than your limits
                            var row = table.insertRow(rowCount);
                            var colCount = table.rows[0].cells.length;
                            for(var i=0; i <colCount; i++) {
                                var newcell = row.insertCell(i);            
                                newcell.innerHTML = table.rows[0].cells[i].innerHTML;  
                            }
                        }else{
                            alert("Maximum Number of choices is 5");                                
                        }
                    }
                    function deleteRow(tableID) {
                        var table = document.getElementById(tableID);
                        var rowCount = table.rows.length;
                            //var chkbox = row.cells[0].childNodes[0];
                            //if(null != chkbox && true == chkbox.checked) {
                                if(rowCount > 2) {   // limit the user from removing all the fields
                                    table.deleteRow(rowCount-1);
                                    rowCount--;
                                }
                                else{          
                                    alert("At least two options are required");
                                }
                    }

</script>





    

