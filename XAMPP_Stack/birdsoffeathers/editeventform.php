<?php
    include("session.php");;
    include("topbardata.php");
    if($_SESSION['login_role'] !== 'Admin' and $_SESSION['login_role'] !== 'SuperUser' ){
        header("location: index.php");
     }
    if( isset($_POST['submit']) )
	{
		
		$id = $_POST['id'];
		$newName=$_POST['newName'];
$newlocation=$_POST['newlocation'];
$newstart=$_POST['newstart'];
$newend=$_POST['newend'];
$newregis=$_POST['newregis'];
$newseats=$_POST['newseats'];
$newfee=$_POST['newfee'];
		$sql = "UPDATE Events SET EventName='$newName',Location='$newlocation',StartDateTime='$newstart',EndDateTime='$newend',Registration_EndDate='$newregis',Availableseats='$newseats',EventFee='$newfee' WHERE EventID='$id'";
		$res = mysqli_query($db,$sql) or die("Could not update".mysqli_error());
		echo "<p style='color:maroon;'>you action is successfully completed</p>";
		echo "<h2><center>Page re-directing to Events page</center></h2>";
		echo "<meta http-equiv='refresh' content='5;url=allevents.php'>";
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
    <link rel="stylesheet" href="css/foundation-datepicker.css" />
    <script src="js/vendor/modernizr.js"></script>
<style>/*
#form {
    background-color: #FFF;
    height: 480px;
    width: 480px;
    margin-right: auto;
    margin-left: auto;
    margin-top: 0px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    padding-right : 60px;
    text-align:center;
}
.form > label
{
  float: left;
  clear: right;
}

.form > input
{
  float: right;
}
label {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-size: 18px;
    color: #333;
    height: 20px;
    width: 200px;
    margin-top: 10px;
    margin-left: 10px;
    text-align: right;
    margin-right:15px;
    float:left;
}
input {
    height: 20px;
    width: 300px;
    border: 1px solid #000;
    margin-top: 10px;
}
.header {
    padding: 10px;
    text-align: center;
    background: #9f1d2a;
    color: white;
}
fieldset
{
  
  max-width:650px;
  padding-left:46px;
  
padding-bottom:36px;  
}
body {
    
    padding: 10px;
    background: #ffdf3b;
    
}
.left{
  float:left;
}
form { 
margin: 0 auto; 
width:250px;
}
p{
	text-align:center;
	font-size:40px;
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
<?php

 if( isset($_GET['EventID']) )
	{
		$id = $_GET['EventID'];
		$res= mysqli_query($db,"SELECT * FROM Events WHERE EventID='$id'");
		$row= $res->fetch_object();
	}
    if( isset($_POST['id']) )
	{
		$id = $_POST['id'];
		$res= mysqli_query($db,"SELECT * FROM Events WHERE EventID='$id'");
		$row= $res->fetch_object();
	}
	/*if( isset($_POST['submit']) )
	{
		
		$id  	 = $_POST['id'];
		$newName=$_POST['newName'];
$newlocation=$_POST['newlocation'];
$newstart=$_POST['newstart'];
$newend=$_POST['newend'];
$newregis=$_POST['newregis'];
$newfee=$_POST['newfee'];
		$sql     = "UPDATE events SET EventName='$newName',Location='$newlocation',StartDateTime='$newstart',EndDateTime='$newend',Registration_EndDate='$newregis',EventFee='$newfee' WHERE EventID='$id'";
		$res 	 = mysqli_query($conn,$sql) or die("Could not update".mysqli_error());
		echo "<p style='color:maroon;'>you action is successfully completed</p>";
		echo "<h2>Page re-directing to Events page</h2>";
		echo "<meta http-equiv='refresh' content='5;url=allevents.php'>";
	}
 mysqli_close($conn);*/
?>
<center>
<h3>Event-Edit</h3>
</center>
<div class="row">
        <div class="small-12 columns" align="center">
<div id="form">
<form action="editeventform.php" method="POST" >

<div class="form-row">
  <label for="EventName">EventName:</label>
    <input type="text" name="newName" value="<?php echo $row->EventName; ?>"<?php if($_SESSION['login_role'] !== 'Admin') echo " readonly"?>>
</div>
<div class="form-row">
<label for="Location">Location:</label>
<input type="text" name="newlocation" value="<?php echo $row->Location; ?>"<?php if($_SESSION['login_role'] !== 'Admin') echo " readonly"?>>
</div>
<div class="form-row">
<label for="StartDateTime">StartDateTime:</label>
<input type="text" class="span2" placeholder ="YYYY-MM-DD hh:mm"  name="newstart" value="<?php echo date("Y-m-d H:i" ,strtotime($row->StartDateTime)); ?>"
<?php if($_SESSION['login_role'] !== 'Admin') {echo " readonly";} else {echo ' id="dpt1"';}?>>
</div>
<div class="form-row">
<label for="EndDateTime">EndDateTime:</label>
<input type="text" class="span2" placeholder ="YYYY-MM-DD hh:mm"name="newend" value="<?php echo date("Y-m-d H:i" ,strtotime($row->EndDateTime)); ?>"
<?php if($_SESSION['login_role'] !== 'Admin') {echo " readonly";} else {echo ' id="dpt2"';}?>>
<div class="form-row">
<div class="form-row">
<label for="Registration_EndDate">Registration_EndDate:</label>
<input type="text" class="span2" placeholder ="YYYY-MM-DD" name="newregis" value="<?php echo date("Y-m-d" , strtotime($row->Registration_EndDate)); ?>"
<?php if($_SESSION['login_role'] !== 'Admin') {echo " readonly";} else {echo ' id="dp1"';}?>>
<div class="form-row">
<label for="AvailableSeats">AvailableSeats:</label>
<input type="text" name="newseats" value="<?php echo $row->AvailableSeats; ?>"<?php if($_SESSION['login_role'] !== 'Admin') echo " readonly"?>></div>
<div class="form-row">
<label for="EventFee">EventFee:</label>
<input type="text" name="newfee" value="<?php echo $row->EventFee;?>" <?php if($_SESSION['login_role'] !== 'SuperUser') echo " readonly"?> >
</div>
<div class="form-row">
<!--<label for="EventID">EventID:</label> -->
<input type="hidden" name="id" value="<?php echo $row->EventID; ?>">
</div>

<input type="submit" value=" Update " name="submit" class="labelbutton"/>

</form>

</div>
</div>
</div>
<footer>
            <p style="text-align:center; font-size:0.8em;">&copy; Birds of Feathers. All Rights Reserved.</p>
            </footer>
</body>
<script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script src="js/foundation-datepicker.js"></script>
        <script>
        $(document).foundation();
        </script>
</html>
<script>
    $(function(){
                    var d = new Date();
                    $('#dpt1').fdatepicker({
                    startDate: d,
					format: 'yyyy-mm-dd hh:ii',
					disableDblClickSelection: true,
					//language: 'vi',
                    pickTime: true,
                    leftArrow:'<<',
                    rightArrow:'>>',
                    closeIcon:'X',
                    closeButton: true
                });
                $('#dpt2').fdatepicker({
                    startDate: d,
					format: 'yyyy-mm-dd hh:ii',
					disableDblClickSelection: true,
					//language: 'vi',
                    pickTime: true,
                    leftArrow:'<<',
                    rightArrow:'>>',
                    closeIcon:'X',
                    closeButton: true
                });
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
    </script>