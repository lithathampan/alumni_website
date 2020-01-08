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
    <div align="center">
<h1>ADD/DELETE NEWS </h1>
    <?php

  // Initialize message variable
  $msg = "";
// If upload button is clicked ...
  if (isset($_POST['upload'])) 
  {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $image = $_FILES['image']['name'];
    $content = mysqli_real_escape_string($db, $_POST['content']);
    $target = "images/news/".basename($image);
  
    echo "code reached line 50";
	  $sql = "INSERT INTO NewsContent (NewsTitle, NewsTimestamp, NewsImage, NewsContent , NewsContentStatus) VALUES ('$title', NOW(), '$image', '$content','Active')";
  	
  	mysqli_query($db, $sql);
   
	  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
      header("location:editnews.php");
    }
// If delete button is clicked ... 
    if (isset($_GET['delete']))
    {
      $sql = "DELETE FROM NewsContent WHERE NewsID='".$_GET["delete"]."'";
      mysqli_query($db, $sql);
      unlink("images/news/".$_GET['newsimages']);
      
    }
    ?>

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
        echo "<div class='small-4'>";
        echo '<label name="delete" class = "labelbutton"> <a href="?delete='.$row['NewsID'].'&newsimages='.$row['NewsImage'].'">Delete</a></label>';
               echo "<br>";
        echo "</div>";

             }//end of loop 

?>
          </div>
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
    <form method="POST" action="editnews.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="100000000">
  	<h3>Add News</h3>
        Title: <input name="title" size="40" maxlength="255">
        <br>
        <div>
  	  <input type="file" name="image">
      </div>
  	<div>
      <textarea 
      	id="content" 
      	cols="40" 
      	rows="15" 
      	name="content" 
      	placeholder="enter the news here"></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload" value="submit" class="labelbutton">POST</button>
  	</div>
	  
    </div>
    </div>
  </form>
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