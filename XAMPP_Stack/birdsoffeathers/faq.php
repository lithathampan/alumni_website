<?php
include_once("config.php");
include("topbardata.php");
session_start();

?>
<!doctype html>
<html>
   
   <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Maggotty Alumni Association</title>
        <link rel="stylesheet" href="css/foundation.css" /> 
        <link rel="stylesheet" href="css/foundation-datepicker.css" />
        <link rel="stylesheet" href="css/foundation-icons.css" />
        <link rel="stylesheet" href="css/app.css" />
        <script src="js/vendor/modernizr.js"></script>      
   </head>

<style type="text/css">
/*body {
    background: #ffdf3b;
    color: #9f1d2a;
    padding: 0;
    margin: 0;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    font-weight: normal;
    font-style: normal;
    line-height: 150%;
    position: relative;
    cursor: default; }
.faq_holder{
    text-align:left;
    width: 5000px;
    margin-left: auto;
    margin-right: auto;
    padding: 4px;
    border: 1px solid #ffdf3b;
}
*/
.faq{
    margin-bottom: 10px;
    
}


.questions{
  font-weight: bold;
    font-size: 16px;
    }
    .answers{
        margin-left: 20px;
}

    
</style>
</head>
<body>
<nav class="top-bar" data-topbar role="navigation" background="white">
      <ul class="title-area">
        <li class="name">
        <h1><a href="faq.php"><i class="fi-home large"></i> Maggotty Alumni Association US Northern Region</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          
        <?php
          topbarul('faq');
          ?>
        </ul>
      </section>
    </nav>
<div class="row" align="center">
<h1>F.A.Q </h1>

<h2> Frequently Asked Questions</h2>
<div class="small-12 columns" align="left">

<?php
$sql = "SELECT * FROM FAQContent";
$res = mysqli_query($db,$sql) or die(mysql_error());
if (mysqli_num_rows($res)> 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)){
        $questions = $row['FAQQuestion'];
        $answers = $row['FAQAnswer'];
        echo'<div class="faq"><span class="questions">'.$i.'.'.$questions.'</span><br /><div class="answers">'.$answers.'</div></div>';
        $i++;
    }
}else{
    echo "there are no FAQs at this time";
}
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