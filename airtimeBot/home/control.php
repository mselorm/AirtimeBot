<?php
session_start();
if (!isset($_SESSION['login'])){

header("location: ../index.html ");

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AirtimeBot | Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="./anime.css">
  <link rel="stylesheet" href="./nav.css">
  <link rel="stylesheet" href="./style.css">

  </head>
  <body>


<div class="all" style="display: none;">
<div class="bar">
<a href="logout.php"><img class="logout" src="logout.png" alt="" width="40" height="40"></a>
</div>
<div class="  controlbar">
<a class="navbar-brand brand-logo" href="#">
    
    <nav class="sidebar sidebar-offcanvas" id="sidebar" >
    
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">

                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">Admin</p>
              
              </div>



            </a>
          </li>
          <li class="nav-item nav-category">Main Menu</li>
          <li class="nav-item active">
            <a class="nav-link" href="#" id="all">
              <i class="menu-icon typcn document-text" id="all"></i>
              <span class="menu-title" id="all">View  All Records</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="modifycustomer">
              <i class="menu-icon typcn typcn-shopping-bag" id="modifycustomer"></i>
              <span class="menu-title" id="modifycustomer">View Pending Deliveries</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"  id="viewrecent_signup_">
              <i class="menu-icon typcn typcn-coffee1" id="viewrecent_signup_"></i>
              <span class="menu-title" id="viewrecent_signup_">Sign Up new Customer</span>
              
            </a>
    
          </li>
     
          <li class="nav-item">
            <a class="nav-link" href="#" id="viewrecent_signup">
              <i class="menu-icon typcn typcn-document-text" id="viewrecent_signup"></i>
              <span class="menu-title" id="viewrecent_signup">View Recent Sign Ups</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon typcn typcn-th-large-outline" id="recent_collections"></i>
              <span class="menu-title" id="recent_collections">View Recent Collections</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="collect_add">
              <i class="menu-icon typcn typcn-bell" id="collect_add"></i>
              <span class="menu-title" id="collect_add">Add New Collection</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" id="agent_activity">
              <i class="menu-icon typcn typcn-user-outline" id="agent_activity"></i>
              <span class="menu-title" id="agent_activity">View Sales Agent Activity</span>     
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#" aria-expanded="false" aria-controls="auth" id="new_member" data-toggle="modal">
              <i class="menu-icon typcn typcn-document-add" id="new_member" data-toggle="modal" ></i>
              <span class="menu-title" id="new_member" data-toggle="modal" >Add Signup/Collection Agent</span>
              <i class=""></i>
            </a>
  
          </li>
        </ul>
      </nav>



<style>
  body{
	background-color: #f1f1f1;
}
</style>

</div>
</div>

<header>
    
    <section>
        <div class="hero ">
            <img src="./img/robot_limbs.png" alt="" srcset="">
            <h4 class="headline ">Dream Brich</h4>
        </div>
    </section>

</header>

<div class="slider "></div>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweenjs/1.0.2/tweenjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TimelineMax.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>
 