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
          topbarul('contactus');
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
            <p style="text-align:left;font-size:1.5em;">Contact Us</p>
          </div>
    </div>
    <div class="row" >
          <div class="small-12 columns">
            <p>
            <i class="fi-map large"></i> Maggotty High School, Maggotty 
            
               St. Elizabeth<br />
          <br />
          <i class="fi-telephone large"></i> Call Free: +1 876-997-2900<br />
         <br />
         <i class="fi-clock large"></i> Monday - Friday: 8AM - 5PM<br />
         <br />     
        <i class="fi-mail large"></i><span style="text-decoration: underline;"><a href ="http://magghigh@yahoo.com" style="color: #9f1d2a"> magghigh@yahoo.com</a></span>
        </p>
</div> 
    </div>
    <div class="row" style="margin-top:10px;">
          <div class="small-12">
            <p style="text-align:left;font-size:1.5em;">Important Contacts: </p>
          </div>
    </div>
    <div class="row">
          <div class="small-12">
            <p><span style="display: block; text-align:left; line-height: 30px; font-family: 'Work Sans', sans-serif; font-size: 15px;">
            <table style="table-layout: fixed;display: block;background: transparent; border:none">
             <tr style="background: transparent;color: #9f1d2a ">
             <td> <a style="color: #9f1d2a"><i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> President</td>
            <td><a style="color: #9f1d2a"> HJ</td>
            <td> <a style="color: #9f1d2a"><i class="fi-mail large"></i> <a href ="http://hubiej03@gmail.com" style="text-decoration: underline;color: #9f1d2a" > hubiej03@gmail.com</a></td>
            </tr> 
            <tr style="background: transparent;color: #9f1d2a">
            <td> <a style="color: #9f1d2a"><i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> Vice President</td>
            <td><a style="color: #9f1d2a"> Elton Hanson</td>
            <td> <a style="color: #9f1d2a"><i class="fi-mail large"></i> <a href ="http://eltonsherry@aol.com" style="text-decoration: underline;color: #9f1d2a"> eltonsherry@aol.com</a></td>
            </tr>
            <tr style="background: transparent;color: #9f1d2a">
            <td><a style="color: #9f1d2a"> <i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> Secretary</td>
            <td><a style="color: #9f1d2a"> D. Willians-Wallen</td>
            <td> <a style="color: #9f1d2a"><i class="fi-mail large"></i> <a href ="http://d.willianswallen@gmail.com" style="text-decoration: underline;color: #9f1d2a"> d.willianswallen@gmail.com</a></td>
            </tr>
            <tr style="background: transparent;color: #9f1d2a">
            <td> <a style="color: #9f1d2a"><i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> Treasurer</td>
            <td><a style="color: #9f1d2a"> H. Duhaney</td>
            <td> <a style="color: #9f1d2a"><i class="fi-mail large"></i> <a href ="http://hgd67182@yahoo.com" style="text-decoration: underline;color: #9f1d2a"> hgd67182@yahoo.com</a></td>
            </tr> 
            <tr style="background: transparent;color: #9f1d2a">
            <td> <a style="color: #9f1d2a"><i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> PR</td>
            <td><a style="color: #9f1d2a"> M. S.</td>
            <td></td>
            </tr>
            <tr style="background: transparent;color: #9f1d2a">
            <td> <a style="color: #9f1d2a"><i class="fi-burst large"></i></td>
            <td><a style="color: #9f1d2a"> Event Planner</td>
            <td><a style="color: #9f1d2a"> L. P</td>
            <td></td>
            </tr>
          </table>
            </span>
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