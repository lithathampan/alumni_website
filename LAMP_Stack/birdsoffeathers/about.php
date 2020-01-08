<?php
    include("topbardata.php");
    session_start();
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
          topbarul('about');
          ?>
        </ul>
      </section>
    </nav>
    <div class="row" style="margin-top:10px;" align="center">
          <div class="small-12">
          <img src="images/logo_o.png" alt="Magotty high school logo" style="width:150px;height:150px;">
          </div>
    </div>

    <div class="row" style="margin-top:10px;">
          <div class="small-12">
            <p style="text-align:center;font-size:1.2em;">About Us</p>
          </div>
    </div>
    <div class="row" style="margin-top:10px;">
          <div class="small-12">
            <p><span style="display: block; line-height: 30px; font-family: 'Work Sans', sans-serif; font-size: 15px;">Maggotty High School is a co-educational facility located in North-Western St. Elizabeth. The school began its impact on the community of Maggotty since its inception in 1971. The institution has undergone many changes, moving from a Junior Secondary School in 1971 to new Secondary in 1974. The school has now achieved High School status since 1988.</span><span style="display: block; line-height: 30px; font-family: 'Work Sans', sans-serif; font-size: 15px;"><br />
        The school presently has in its employ approximately ninety-two (92) academic staff members, inclusive of one (1) Principal, two (2) Vice-Principals, three (3) Guidance Counsellors, and one (1) Dean of Discipline.<br />
        </span><span style="display: block; line-height: 30px; font-family: 'Work Sans', sans-serif; font-size: 15px;"><br />
        Maggotty High School boasts a population of approximately two thousand students. The school operates on a shift system with the Morning Shift running from 7:00am to 12:00pm and the Evening Shift from 12:00pm to 5:00pm.<br />
        </span><span style="display: block; line-height: 30px; font-family: 'Work Sans', sans-serif; font-size: 15px;"><br />
        Maggotty High School strives to attain excellence in all aspects of its activities and endeavours.</span></p>
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