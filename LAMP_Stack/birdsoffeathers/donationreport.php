<?php
    include("session.php");
    include("topbardata.php");
    $successmessage = '';
    $error = '';
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
          topbarul('report');
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
        <span class="input-group-cell"><span>Donation Report</span></span>
        </div>
        </div>

<div class="row">
              <div class="small-12 columns" align="center">
<div class="small-12" align="center" style="overflow-x:auto;">

    <table style="table-layout: fixed;overflow:scroll;">
    <?php
    $sql="SELECT Currency,SUM(Amount) As Amount FROM birdsoffeathers.Donation 
    WHERE DonationStatus = 'Completed'
    GROUP BY Currency;";
    $result=mysqli_query($db,$sql);

    //"<table border='1' style='font-size:25px;' width='400' height='380' bordercolor='yellow' align='center' bg-color='white'>

    echo "<tr >

                <th>Currency</th>
                <th>Total Amount</th>
                
            </tr>";

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr style='font-size: 35px;'><center>";
                echo "<td>". $row['Currency']."</td>";
                echo "<td align='center'>". $row['Amount']."</td>";
                
                
                
            echo"</center></tr>";
        }
        }
    else{
        echo "no results";
    }
        echo "</table>";
        mysqli_close($db);

    ?>
 </div>

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