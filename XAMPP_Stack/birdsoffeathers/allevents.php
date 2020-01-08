<?php
    include("session.php");
    //include("admincheck.php");
    include("topbardata.php");
    if($_SESSION['login_role'] !== 'Admin' and $_SESSION['login_role'] !== 'SuperUser' ){
        header("location: index.php");
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
          topbarul('');
          ?>
        </ul>
      </section>
    </nav>
<div>
  <h1 align="center">All Events</h1>
</div>
<div class="row">
        <div class="small-12 columns" align="left" style="margin-bottom:10px;">
<?php if($_SESSION['login_role'] === 'Admin') {echo " <a href='addeventform.php' class='labelbutton' style='float:center'>Add Event</a>";}?>
    </div>
</div>
<div class="row">
        <div class="small-12 columns" align="center">
<!--<a href='eventuser.php' class='labelbutton' style='float:right'>Users</a>-->

        <table style="table-layout: fixed;display: block;overflow:scroll;">
<?php
$sqlEventList="select * from Events";
$result = $db->query($sqlEventList); 
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
            <th>Edit</th>
			<th>Delete</th>

		</tr><t/head><tbody>";

if(mysqli_num_rows($result)>0){
	while($row=$result->fetch_object()){
		echo "<tr>";
			echo "<td>". $row->EventID."</td>";
			echo "<td>". $row->EventName."</td>";
			echo "<td>". $row->Location."</td>";
			echo "<td>". $row->StartDateTime."</td>";
			echo "<td>". $row->EndDateTime."</td>";
			echo "<td>". $row->Registration_EndDate."</td>";
			echo "<td>". $row->AvailableSeats."</td>";
			echo "<td>". $row->EventFee."</td>";
            echo "<td><a href='editeventform.php?EventID=$row->EventID' class='labelbutton'>Edit</a></td>";
            if($_SESSION['login_role'] === 'Admin') {
			echo "<td><a href='deleteevent.php?EventID=$row->EventID' class='labelbutton'>Delete</a></td>";
            }
			
			/*<form action='delete.php' method='post'>
			<input type='submit' value='$row['EventID']' name='delete'/>
			</form>"*/
		echo"</tr>";
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