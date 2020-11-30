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
  </head>
  <body>

    <header>
        <nav>

            <h3 id="logo"> AirtimeBot | Control Panel </h3>

            <img src="./Hamburger_icon.svg.png" alt="" srcset="" class="humburger">
        </nav>
        <section>
            <div class="hero">
                <img src="./img/robot_limbs.png" alt="dream" srcset="">
                <h1 class="headline"> Powered by Brich Company</h1>
            </div>
        </section>

    </header>

    <div class="slider"></div>








    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweenjs/1.0.2/tweenjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TimelineMax.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
  </body>
</html>
 