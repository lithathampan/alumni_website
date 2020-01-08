<?php
function topbarul($activepage)
{
    if(isset($_SESSION['login_user'])){
        if ($_SESSION['login_role'] === 'Admin'){
           echo '<li class="has-dropdown"><a href="#">Administrator</a>';
           echo '<ul class="dropdown">';
           echo '<li><label>Level One</label></li>';
           echo '<li><a href="pendingreg.php">Pending Registrations</a></li>';
           echo '<li><a href="addpoll.php">Add New Poll</a></li>';
           echo '<li class="has-dropdown"><a href="#">Manage FAQ</a>';
           echo '<ul class="dropdown">';
           echo '<li><label>Level Two</label></li>';
           echo '<li><a href="addfaq.php">Add New FAQ</a></li>';
           echo '<li><a href="editfaq.php">Edit New FAQ</a></li>';
           echo '</ul>';
           echo '</li>';
           echo '<li><a href="editnews.php">Edit News</a></li>';
           echo '<li><a href="allevents.php">Manage Events</a></li>';
           echo '</ul>';
           echo '</li>';
         }
        if ($_SESSION['login_role'] === 'SuperUser'){
           echo '<li class="has-dropdown"><a href="#">SuperUser</a>';
           echo '<ul class="dropdown">';
           echo '<li><label>Level One</label></li>';
           echo '<li><a href="paymentreport.php">Transaction Report</a></li>';
           //echo '<li><a href="findataentry.php">FinancialDataEntry</a></li>';
           echo '<li><a href="allevents.php">Manage Events</a></li>';
           echo '</ul>';
           echo '</li>';
         }
        }
         echo '<li class="divider"></li>';
         echo '<li'.($activepage == 'about' ? ' class="active"' : '').'><a href="about.php">About</a></li>';
         echo '<li'.($activepage == 'event' ? ' class="active"' : '').'><a href="event.php">Events</a></li>';
         echo '<li'.($activepage == 'news' ? ' class="active"' : '').'><a href="news.php">News</a></li>';
         echo '<li'.($activepage == 'faq' ? ' class="active"' : '').'><a href="faq.php">FAQ</a></li>';
         echo '<li'.($activepage == 'contactus' ? ' class="active"' : '').'><a href="contactus.php">Contact Us</a></li>';
      if(isset($_SESSION['login_user'])){
         echo '<li'.($activepage == 'content' ? ' class="active"' : '').'><a href="galleryupload.php">Content</a></li>';
         echo '<li class="has-dropdown"><a href="#">Reports</a>';
         echo '<ul class="dropdown">';
         echo '<li><label>Level One</label></li>';
         echo '<li><a href="donationreport.php">Donation Report</a></li>';
         echo '<li><a href="pollreport.php">Poll Report</a></li>';
         echo '<li><a href="eventreport.php">Event Report</a></li>';
         echo '</ul>';
         echo '</li>';
         echo '<li'.($activepage == 'donation' ? ' class="active"' : '').'><a href="donation.php">Donate</a></li>';
         echo '<li'.($activepage == 'polls' ? ' class="active"' : '').'><a href="polls.php">Poll</a></li>';
         echo '<li><a href="logout.php">Log Out</a></li>';
       }
       else{
         echo '<li'.($activepage == 'login' ? ' class="active"' : '').'><a href="login.php">Log In</a></li>';
         echo '<li'.($activepage == 'register' ? ' class="active"' : '').'><a href="register.php">Register</a></li>';
       }
}
?>