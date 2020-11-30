<?php



// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: POST");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
          // echo "success";

            $response = array(
              "status" => "success",
              "message" => "login successful...!"
            );
            $_SESSION['login'] = true;
              } else {
                $response = array(
                  "status" => "failed",
                  "message" => "wrong password"
                );
              }
        }

            if ($row['username'] != $user ){

              $response = array(
                "status" => "failed",
                "message" => "username not found..!"
              );


            }

            $response = json_encode($response);

            echo $response;
   

        }
    }




}