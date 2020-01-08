<?php
 include("session.php");
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
          topbarul('content');
          ?>
        </ul>
      </section>
    </nav>
    <div align="center">
    <h1>Image Gallery </h1>
    <?php

  // Initialize message variable
  $msg = "";
// If upload button is clicked ...
  if (isset($_POST['upload'])) 
  {
    // $title = mysqli_real_escape_string($db, $_POST['title']);
    $content = mysqli_real_escape_string($db, $_POST['content']);
    $userid = $_SESSION['login_user'];
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'tiff', 'img');

    if (in_array($fileActualExt, $allowed))
    {
      if ($fileError === 0) {
        if($fileSize < 1000000){
          $fileNameNew = uniqid('',true).".".$fileActualExt;
            if (!file_exists('usercontent/images/'.$userid)) {
                mkdir('usercontent/images/'.$userid, 0777, true);
            }
          $fileDestination = 'usercontent/images/'.$userid.'/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          header("Location: galleryupload.php?uploadsuccess");
          //$sql = "INSERT INTO gallery (timestamp, image, content) VALUES (NOW(), '$fileNameNew', '$content')";
          $sql = "INSERT INTO UserContent(`UserID`,`ContentType`,`ContentPath`,`UploadedDate`,`ShareFlag`,`ThumbNailPath`, `ContentDescription`) 
          VALUES($userid,'Image','$fileDestination',NOW(),'Private','','$content')";
          mysqli_query($db, $sql);

        } else {
          echo "Your file is too big!";
        } 
      }
        else {
          echo "There was an error uploading your file!";
        }
      }
      header("Location: galleryupload.php");
    } 
    
// If delete button is clicked ... 
    if (isset($_GET['delete']))
    {
      $sql = "DELETE FROM UserContent WHERE UserContentID='".$_GET["delete"]."'";
      mysqli_query($db, $sql);
      unlink($_GET['image']);
      header("Location: galleryupload.php");
    }
    if (isset($_GET['share']))
    {
      $sql = "UPDATE UserContent SET ShareFlag ='Public'  WHERE UserContentID='".$_GET["share"]."'";
      mysqli_query($db, $sql);
      //unlink($_GET['image']);
      header("Location: galleryupload.php");
    }
    if (isset($_GET['private']))
    {
      $sql = "UPDATE UserContent SET ShareFlag ='Private'  WHERE UserContentID='".$_GET["private"]."'";
      mysqli_query($db, $sql);
      //unlink($_GET['image']);
      header("Location: galleryupload.php");
    }
   ?>
          </div>
    </div>
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
      <div id="content">
      <span class="input-group-cell"><span>Private Photos</span></span>
      <table style="table-layout: fixed;overflow:scroll;">
  <?php
    $userid = $_SESSION['login_user'];
   $sql= "SELECT * FROM UserContent where UserID = $userid and ShareFlag = 'Private' ";
   $result = mysqli_query($db, $sql);
   $i=0;
   while($row= mysqli_fetch_assoc($result)) {

    if($i%3 == 0){
      echo "<tr>";
    }
    echo "<td><img src='{$row['ContentPath']}' alt='{$row['ContentDescription']}'>";
    echo "<p>".$row['ContentDescription']." ";
    echo '<a href="?delete='.$row['UserContentID'].'&image='.$row['ContentPath'].'" align="top">(X)</a>';
    echo '<a href="?share='.$row['UserContentID'].'&image='.$row['ContentPath'].'" align="top">(S)</a></p></td>';
    if($i%3 == 2) {
      echo "</tr>"; 
    }
    $i++;
  }
  ?>
  </table>
</div>
  
      <div id="content">
      <span class="input-group-cell"><span>Public Photos</span></span>
      <table style="table-layout: fixed;overflow:scroll;">
  <?php
    $userid = $_SESSION['login_user'];
   $sql= "SELECT * FROM UserContent where ShareFlag = 'Public' ";
   $result = mysqli_query($db, $sql);
   $i=0;
   while($row= mysqli_fetch_assoc($result)) {

    if($i%3 == 0){
      echo "<tr>";
    }
    echo "<td><img src='{$row['ContentPath']}' alt='{$row['ContentDescription']}'>";
    echo "<p>".$row['ContentDescription']." ";
    if($userid === $row['UserID'] )
    echo '<a href="?private='.$row['UserContentID'].'&image='.$row['ContentPath'].'" align="top">(P)</a>';
    if($_SESSION['login_role'] === 'Admin' or $userid === $row['UserID'] )
    echo '<a href="?delete='.$row['UserContentID'].'&image='.$row['ContentPath'].'" align="top">(X)</a>';
    echo '</p></td>';
    if($i%3 == 2) {
      echo "</tr>"; 
    }
    $i++;
  }
  ?>
  </table>
  </div>
 <form method="POST" action="galleryupload.php" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="100000000">
  	<h3>Upload Photos</h3>
        <!-- Title: <input name="title" size="40" maxlength="255">
        <br> -->
        <div>
  	  <input type="file" name="image">
      </div>
  	<div>
      <textarea 
      	id="content" 
      	cols="40" 
      	rows="2" 
        maxlength="255"
      	name="content" 
      	placeholder="Enter description of the photo (optional)"></textarea>
  	</div>
  	<div>
  		<button type="submit" name="upload" value="submit" class= "labelbutton">Upload</button>
      </div>
      
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