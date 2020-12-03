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



<style>
  body{
	background-color: #f1f1f1;
}
</style>


<header>
    
    <section>
        <div class="hero ">
            <!-- <img src="./img/robot_limbs.png" alt="" srcset=""> -->
            <h6 class="headline "></h6>
        </div>
    </section>

</header>

<div class="slider "></div>



<div class="container-fluid">

<h1 style="color: white">only view the page in dosktop mode</h1>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweenjs/1.0.2/tweenjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TimelineMax.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="app.js"></script>

    <script>
  console.log($(window).width());
  setInterval(() => {
    if ($(window).width() > 1000) {
    window.location = "./control/dashboard.php";  
}
    
  }, 2000);

</script>


  </body>
</html>
 