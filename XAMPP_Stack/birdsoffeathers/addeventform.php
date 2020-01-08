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
    <link rel="stylesheet" href="css/foundation-datepicker.css" />
    <script src="js/vendor/modernizr.js"></script>
<style>
    /*
#form {

    height: 450px;
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
*/
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
<h2 align="center" style="color: maroon;">Add Events</h2>
<div class="row">
        <div class="small-12 columns" align="center">
<div id="form">
<form action="addevent.php" method="post" style="align:center">
<table align="center">
            <tr>
				<td>EventID:</td>
				<td><input type="text" name="EventID" disabled></td>
			</tr>
			<tr>
				<td>EventName:</td>
				<td><input type="text" name="EventName"></td>
			</tr>
			<tr>
				<td>Location:</td>
				<td><input type="text" name="Location"></td>
			</tr>
			<tr>
				<td>StartDateTime:</td>
				<td><input type="text" class="span2" placeholder ="YYYY-MM-DD hh:mm" id="dpt2" name="StartDateTime"></td>
			</tr>
			<tr>
				<td>EndDateTime:</td>
                <td><input type="text" class="span2" placeholder ="YYYY-MM-DD hh:mm" id="dpt1" name="EndDateTime"></td>
                
			</tr>
			<tr>
				<td>Registration_EndDate:</td>
				<td><input type="text" class="span2" placeholder ="YYYY-MM-DD" id="dp1" name="Registration_EndDate"></td>
			</tr>
			<tr>
				<td>Available seats:</td>
				<td><input type="text" name="Availableseats" ></td>
			</tr>
			<tr>
				<td>EventFee($):</td>
				<td><input type="text" name="EventFee" disabled></td>
			</tr>
			
			
			<tr>
				<td align="right" colspan="2">
				<input type="submit" name= "submit" value="Create" class="labelbutton"><input type="reset" value="Clear" class="labelbutton"></td>
			</tr>


		</table>
		
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
					language: 'vi',
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
					language: 'vi',
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