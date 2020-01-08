<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");

if (isset($_POST['create_faq'])) {
    $question = strip_tags(mysqli_real_escape_string($db,$_POST['question']));
    $answer = strip_tags(mysqli_real_escape_string($db,$_POST['answer']));
 $sqlAddFAQ = "INSERT INTO FAQContent (FAQQuestion, FAQAnswer,FAQStatus) VALUE('".$question."','".$answer."','Active')";
 $result = $db->query($sqlAddFAQ);
 //$res = mysqli_query($db,$sql) or die(mysql_error());
 header("Location: faq.php");
 exit();}

?>

<!Doctype html>
<html>
   
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
      topbarul('');
      ?>
    </ul>
  </section>
</nav>


<div class="row"  align="center">
<div class="small-12 columns">
<h1>F.A.Q </h1>

<h3>Add NEW FAQ</h3>

<form action="addfaq.php" method="post">
Question:<input type="text" name="question" size="0"/><br /><br />
Answer:<input type="text" name="answer" size="65"/><br /><br />
<input type="submit" name="create_faq" value="Add New FAQ" class="labelbutton" />
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