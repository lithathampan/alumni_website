<?php
    include("session.php");
    include("topbardata.php");
    if($_SESSION['login_role'] !== 'SuperUser' ){
        header("location: index.php");
     }
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
        <span class="input-group-cell"><span>Transaction Report</span></span>
        </div>
        </div>

<div class="row">
              <div class="small-12 columns" align="center">
<div class="small-12" align="center" style="overflow-x:auto;">

    <table style="table-layout: fixed;display: block;overflow:scroll; border: 1px solid #ff0000;">
    <?php
    $sql="SELECT TransactionID,PType,SubType,FirstName,LastName,PaymentSystem_TransID,Currency,Amount,TransactionStatus,TransactionDateTime
    FROM birdsoffeathers.Online_Transactions OT
    inner join (select DonationID  as TranID,UserID,'Donation' PType ,Amount ,'NA' SubType  from birdsoffeathers.Donation
    union all 
    select Event_RegistrationID as TranID,UserID,'Event Registration' PType,EventFee Amount,EventName SubType from birdsoffeathers.EventRegistration ER
    inner join birdsoffeathers.Events E on E.EventID=ER.EventID) T 
    on (OT.DonationID = T.TranID and T.PType ='Donation' )or (OT.Event_RegistrationID = T.TranID and T.PType ='Event Registration' )
    inner join birdsoffeathers.User on T.UserID = User.UserID
    inner join birdsoffeathers.UserProfile on User.UserID = UserProfile.UserID
    order by TransactionID desc;";
    $result=mysqli_query($db,$sql);

    //"<table border='1' style='font-size:25px;' width='400' height='380' bordercolor='yellow' align='center' bg-color='white'>

    echo "<tr >

                <th>Transaction ID</th>
                <th>Transaction Type</th>
                <th>Sub Type</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Payment System ID</th>
                <th>Currency</th>
                <th>Amount</th>
                <th>Transaction Status</th>
                <th>Transaction Time</th>
            </tr>";

    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr style='font-size: 35px;'><center>";
                echo "<td align='center'>". $row['TransactionID']."</td>";
                echo "<td align='center'>". $row['PType']."</td>";
                echo "<td align='center'>". $row['SubType']."</td>";
                echo "<td align='center'>". $row['FirstName']."</td>";
                echo "<td align='center'>". $row['LastName']."</td>";
                echo "<td align='center'>". $row['PaymentSystem_TransID']."</td>";
                echo "<td align='center'>". $row['Currency']."</td>";
                echo "<td align='center'>". $row['Amount']."</td>";
                echo "<td align='center'>". $row['TransactionStatus']."</td>";
                echo "<td align='center'>". $row['TransactionDateTime']."</td>";
                       
                
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