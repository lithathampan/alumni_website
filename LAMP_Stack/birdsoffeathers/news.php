<?php
    include("topbardata.php");
    include("config.php"); 
    session_start();
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
          topbarul('news');
          ?>
        </ul>
      </section>
    </nav>
    <div class="row" style="margin-top:10px;" align="center">
          <div class="small-12">
          <h1>NEWS </h1>
          </div>
    </div>

    <div class="row" style="margin-top:10px;">
          <div class="small-12">
          <?php 

// load the configuration file. 

        //load all news from the database and then OREDER them by newsid 
        //you will notice that newly added news will appear first. 
        //also you can OREDER by (timestamp) instead of (news_id) 
        $sql = "SELECT * FROM NewsContent ORDER BY NewsID DESC"; 

       //lets make a loop and get all news from the database 
    
       $result = mysqli_query($db, $sql);
       while( $row= mysqli_fetch_array($result)) {
       //begin of loop 
   //now print the results: 
        echo "<div id='img_div'>";
        echo "<b><br>Title: "; 
        echo $row['NewsTitle']; 
        echo "</b><br>On: <i>"; 
        echo $row['NewsTimestamp']; 
        echo "</i><hr align=left width=160>";
        echo "<img src='images/news/".$row['NewsImage']."'>";
        echo "<p>".$row['NewsContent']." </p>";
        echo "</div>"; 
              
               echo "<br>";
               

             }//end of loop 

?>
          </div>
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