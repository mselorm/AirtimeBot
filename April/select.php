<?php
$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");


    $details = mysqli_query($connect, "SELECT * FROM vehicle_csv");

       while($row = mysqli_fetch_array($details)){

            echo "it worked";
       }