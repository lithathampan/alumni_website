<?php
    //include("session.php");
    include("topbardata.php");
    include("config.php");
    session_start();
    $error = '';
    $successmessage ='';
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $userid = $_SESSION['login_user'];
            // username and password sent from form            
            $eventid = mysqli_real_escape_string($db,$_POST['eventid']);
            $submittype = mysqli_real_escape_string($db,$_POST['submittype']);
            if ($userid === null){
                header("location: login.php");
            }
            if ($eventid == ""){
                throw new Exception("Registration Failed Contact Administrator");
            }
            if ($submittype == "register"){
            $sqlEvent = "CALL `birdsoffeathers`.`sp_event_register`($userid,$eventid,'No');";
            }
            else
            {
                $sqlEvent = "select Event_RegistrationStatus as v_eventregistrationstatus, Event_RegistrationID as v_eventregistrationid
                from EventRegistration where EventID = ".$eventid." and UserID = ".$userid;
            }
            //$sql = "SELECT UserId FROM `Users` WHERE UserName = '$myusername' and `Password` = '$mypassword'";
            //echo $sql;
            $result = $db->query($sqlEvent);
            $db->next_result();
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
                if($row->v_eventregistrationstatus == 'Pending'){                        
                    $_SESSION['eventregistrationid'] = $row->v_eventregistrationid;
                    header("location: payment.php");
                }
                else {
                    $successmessage = 'Event Registered Successfully';
                }
            }else {
                throw new Exception("Unknown Error Occurred");
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
<style>
/*.image{
	background-image:url("images/Maggotty_High.jpg");
}

body {
    
    padding: 10px;
    background: #ffdf3b;
    
}
.header {
    padding: 10px;
    text-align: center;
    background: #9f1d2a;
    color: white;
}
.button {
  background-color: #9f1d2a;
  border: none;
  color: white;
  font-size: 15px;
  padding: 15px 32px;
  text-align: right;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}
table{
	background-color: #cccccc;
}
th{
	font-color="#9f1d2a";
}
td{
	font-size: 15px;
}*/
</style>
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
          topbarul('event');
          ?>
        </ul>
      </section>
    </nav>
<div>
  <h1 align="center">All Events</h1>
</div>

<div class="row">
        <div class="small-12 columns" align="center">

        <table style="table-layout: fixed;display: block;overflow:scroll;">
<?php
if(isset($_SESSION['login_user'])){
    $userid = $_SESSION['login_user'];
}
else {
    $userid = -1;
}
$sqlEventList="SELECT Events.EventID, EventName, Location, StartDateTime, EndDateTime, Registration_EndDate, EventFee, AvailableSeats, 
case when EventRegistration.Event_RegistrationStatus is null then 'NotRegistered' when EventRegistration.Event_RegistrationStatus = 'Pending' then 'Pending' else 'Registered' end RegStatus  FROM birdsoffeathers.Events 
left join EventRegistration on Events.EventID = EventRegistration.EventID and EventRegistration.UserID = ".$userid .";";
$result = $db->query($sqlEventList); 
$db->next_result();
/*echo "<table border='1' style='font-size: small;' width='800' height='400' bordercolor='yellow' align='center' bg-color='white'>

		<!--<tr>
			<td colspan='11'><h2 align='right'>
					<a href='eventuser.php'>users</a>
				</h2></td>
		</tr>-->		
		<!--<tr>
			<td colspan='11'><h2 align='right'>
					<a href='eventform.php'>add event</a>
				</h2><h2 align='left'>
					<a href='eventuser.php'>users</a>
				</h2></td>
        </tr>-->*/
        echo"
		<thead><tr>

        <th>Event Id</th>
        <th>Event Name</th>
        <th>Location</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Registration EndDate</th>
        <th>Available Seats</th>
        <th>Event Fee($)</th>
        <th>Register</th>
       
    </tr></thead><tbody>";

if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
    echo '<tr><form action="" method="post">';
        echo "<td>". $row['EventID']."</td>";
        echo "<td>". $row['EventName']."</td>";
        echo "<td>". $row['Location']."</td>";
        echo "<td>". $row['StartDateTime']."</td>";
        echo "<td>". $row['EndDateTime']."</td>";
        echo "<td>". $row['Registration_EndDate']."</td>";
        echo "<td>". $row['AvailableSeats']."</td>";
        echo "<td>". $row['EventFee']."</td>";
        if($row['RegStatus'] == 'Registered'){
            echo "<td>Registered</td>";
        }
        else if($row['RegStatus'] == 'Pending'){
            echo "<td><input type='hidden' name='eventid' value='".$row['EventID']."' />";
            echo "<input type='hidden' name='submittype' value='payment' />";
            echo "<input type='submit' name='submit' class='labelbutton' value='Pay'/></td>";
            }	
        else{
        echo "<td><input type='hidden' name='eventid' value='".$row['EventID']."' />";
        echo "<input type='hidden' name='submittype' value='register' />";
        echo "<input type='submit' name='submit' class='labelbutton' value='Register'/></td>";
        }	
			/*<form action='delete.php' method='post'>
			<input type='submit' value='$row['EventID']' name='delete'/>
			</form>"*/
		echo"</form></tr>";
	}
	
}
else{
	echo "no results";
}

/*if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
*/

		

	echo "</tbody></table>";
	mysqli_close($db);



?>
    </div>
</div>
<div class="row">
              <div class="small-12 columns" align="center">
                    <label for="right-label" class="right inline"><?php echo $successmessage; ?></label>
                    </div>

              </div>
    <div class="row">
        <div class="small-12 columns" align="right">
        <span class="input-group-error">
        <span class="input-group-cell"></span>
        <span class="input-group-cell"><span class="error-message"><?php echo $error; ?></span></span>
        </div>

<footer>
            <p style="text-align:center; font-size:0.8em;">&copy; Birds of Feathers. All Rights Reserved.</p>
            </footer>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation-datepicker.js"></script>
<script>
$(document).foundation();
</script>
</body>
</html>