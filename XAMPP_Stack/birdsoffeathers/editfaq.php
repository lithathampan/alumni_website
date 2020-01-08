<?php
    include("session.php");
    include("admincheck.php");
    include("topbardata.php");


if(isset($_GET['faq'])){
$faq = strip_tags(mysqli_real_escape_string($db,$_GET['faq']));}

if (isset($_POST['edit_faq'])){
    $question = strip_tags(mysqli_real_escape_string($db,$_POST['question']));
    $answer = strip_tags(mysqli_real_escape_string($db,$_POST['answer']));
 $sqlUpdate = "UPDATE FAQContent SET FAQQuestion='".$question."', FAQAnswer= '".$answer."' WHERE FAQID='".$faq."' LIMIT 1";
 //$res = mysqli_query($db,$sql) or die(mysql_error());
 $result = $db->query($sqlUpdate);
 header("Location: faq.php");
 exit();
}
if (isset($_POST['delete_faq'])){
    $sqlDelete = "DELETE FROM FAQContent WHERE FAQID='".$faq."' LIMIT 1";
   // $res = mysqli_query($db,$sql) or die(mysql_error());
   $result = $db->query($sqlDelete);
    header("Location: editfaq.php");
    exit();
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
    <script src="js/vendor/modernizr.js"></script>

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
    text-align: right;
    width: 550px;
    margin-left: auto;
    margin-right: auto;
    padding: 4px;
}
.faq{
    margin-bottom: 10px;
}*/
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
      topbarul('');
      ?>
    </ul>
  </section>
</nav>

<div class="row" align="center">
<h1>F.A.Q </h1>
<h3>Edit FAQ</h3>
<div class="small-12 columns">

<?php
$sql = "SELECT * FROM FAQContent";
$res = mysqli_query($db,$sql) or die(mysql_error());
if (mysqli_num_rows($res)>0) {
    $i = 1;
    while ($row= mysqli_fetch_assoc($res)){
        $id = $row['FAQID'];
        $questions = $row['FAQQuestion'];
        $answers = $row['FAQAnswer'];
        echo'<div class="faq"><form action="editfaq.php?faq='.$id.'"method="post">
        <span>Question No: '.$i.'<input type="text" name="question" size="65" value="'.$questions.'"/></span><br />
        <div>Answer: <input type="text" name="answer" size="65" value="'.$answers.'" /></div>
        <input type="submit" name="delete_faq" value="Delete FAQ" class="labelbutton" /><input type="submit" name="edit_faq" value="Submit Changes"  class="labelbutton"/>
        </form></div>
        ';

        $i++;
    }

}else{
    echo "There are no FAQs to edit at this time";
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