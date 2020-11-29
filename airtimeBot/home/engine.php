<?php

function userlogin(){
        include 'db.php';
        extract($_POST);
        // echo "notting..!";

       $user = mysqli_real_escape_string($con, $user);

       $password = mysqli_real_escape_string($con, $password);

      //  $result = mysqli_query($con, "SELECT * FROM airtimebot_users WHERE username = '$user' ");
       $result = mysqli_query($con, "SELECT * FROM airtimebot_users ");

       if(!$result){
         echo mysqli_error($con);
       } else {
           while($row = mysqli_fetch_array($result)) { 
        // $pasword = password_hash($pasword, PASSWORD_DEFAULT);
        if ($row['username'] == $user ){
          // echo "this user is not present!"; echo $row['username'];

          
        if (password_verify($password, $row['PASSWORD'])) {
          echo "success";
      } else echo "wrong password";
        }

            if ($row['username'] != $user ){
              echo " username not found !!!";
            }


   

       }
    }




}