<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");
    
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
/*body {
    
    padding: 10px;
    background: #ffdf3b;
    
}
.header {
    padding: 10px;
    text-align: center;
    background: #9f1d2a;
    color: white;
}
p{
	text-align:center;
	font-size:40px;
}*/
</style>
</head>
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
<?php
echo "<br>";
if(isset($_POST['submit'])){
$EventName=$_POST['EventName'];
$Location=$_POST['Location'];
$StartDateTime=$_POST['StartDateTime'];
$EndDateTime=$_POST['EndDateTime'];
$Registration_EndDate=$_POST['Registration_EndDate'];
$Availableseats=$_POST['Availableseats'];
//$EventFee=$_POST['EventFee'];

/*function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}*/

$sql="INSERT INTO Events(EventName,Location,StartDateTime,EndDateTime,Registration_EndDate,AvailableSeats,EventFee) values('$EventName',
'$Location','$StartDateTime','$EndDateTime','$Registration_EndDate','$Availableseats','0')";

if ($db->query($sql)) {
    echo "<p style='color:maroon;'>you have successfully added an event</p>";
		echo "<h2><center>Page re-directing to Events page</center></h2>";
		echo "<meta http-equiv='refresh' content='5;url=allevents.php'>";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

}
?>
		<footer>
            <p style="text-align:center; font-size:0.8em;">&copy; Birds of Feathers. All Rights Reserved.</p>
            </footer>
</html>