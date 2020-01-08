<?php
    include("session.php");
    include("topbardata.php");
    $successmessage = '';
    $error = '';
    try{
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form            
            $pollid = mysqli_real_escape_string($db,$_POST['pollid']);
            $pollchoice = mysqli_real_escape_string($db,$_POST['pollchoice']); 
            $userid = $_SESSION['login_user'];

            $sqlDecision = "CALL `birdsoffeathers`.`sp_pollparticipation`($userid,$pollid,$pollchoice);";
            $result = $db->query($sqlDecision);
            
            if($result === FALSE)
            {
                throw new Exception($db->error);
            }
         
            $successmessage = 'Thank you for your participation';
                
               
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
    <link rel="stylesheet" href="css/foundation-icons.css" />
    <link rel="stylesheet" href="css/app.css" />
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
          topbarul('polls');
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
        <span class="input-group-cell"><span>Latest Poll</span></span>
        </div>
        </div>

<form action="" method="post">
        <div class="row">
        <div class="small-4 columns">

</div>
<div class="small-8 columns" align="center" style="overflow-x:auto;">
        

        <table style="table-layout: fixed;display: block;overflow:scroll;">
        <?php
        $userid = $_SESSION['login_user'];
        $sqlPoll = "CALL `birdsoffeathers`.`sp_get_latest_poll`('$userid');";
        $pending = $db->query($sqlPoll); 
        if($pending === FALSE){
            $error = $db->error;
        }
        $db->next_result();

        $objPoll = $pending->fetch_object();
        $pollcreatedate = $objPoll->PollCreatedDate;
        $pollenddate = $objPoll->PollEndDate;
        $pollparticipation = $objPoll->Participation;
        $disabletext = $pollparticipation == 'Closed' ? 'disabled' : '';
        if ($successmessage == '') {
            $successmessage = $pollparticipation == 'Closed' ? 'User has already participated in this poll' : '';
        }
        echo '<thead><tr>
        <th>Poll No: '.$objPoll->PollID.'
        <input type="hidden" name="pollid" value="'.$objPoll->PollID.'" /></th>
        <th>Question: '.$objPoll->PollQuestion.'</th>
      </tr></thead><tbody>';
      do {
          echo '<tr>';
         // echo '<td>'.$objCat->RegistrationID.'</td>';
          echo '<td><input type="radio" name="pollchoice" value="'.$objPoll->PollChoiceID.'" '.$disabletext.'></td>';
          echo '<td>'.$objPoll->ChoiceDescription.'</td>';
          echo '</tr>';
      }while($objPoll = $pending->fetch_object())
    ?>
      </tbody>
    </table>
    
  </div>
    </div>
  <div class="row">
                    <div class="small-12 columns" align="center">
                    <label for="right-label" class="right inline"> Created On:<?php echo $pollcreatedate; ?></label>
                    <label for="right-label" class="right inline"> Last Date for Submission:<?php echo $pollenddate; ?></label>
                    </div>
        </div>
        <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="right-label" value="Submit" class="labelbutton" <?php echo $disabletext ?>>
              <input type="reset" id="right-label" value="Reset" class="labelbutton" <?php echo $disabletext ?>>
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
    </form>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>