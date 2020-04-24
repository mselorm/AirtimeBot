<?php
session_start();
header("Access-Control-Allow-Origin: *");
    $conn = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

        if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }

$gsm_Status = '';

$_SESSION['last_id'] = 0;

$gsm_Status = '';
$date = '';
//$number =  's';
//listen for arduino response


$myarr = array();
if (isset($_GET['gsm_status'])) {
    $gsm_Status = $_GET['gsm_status'];


switch ($gsm_Status) {
    case "ready":
            next_($conn);
      
        break;
    case "blue":
          next_($conn);
        break;
    case "green":
        $myarr = explode("," ,$_GET['value']);
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}
      
}           



      if(!empty($myarr)){

        //first
           $first = $myarr[0];
           $phone_ = substr($first, 1, 10);       
           $status_ = substr($first, 11, strlen($first)); 
           echo "cell no. " .$phone_      ;
           echo "<br>";
           echo "cell status. " .$status_      ;

            $sql = "UPDATE vehicle_csv SET status = $status_ WHERE phone  = $phone_";
            $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo  $conn->connect_error;
                    }echo "<br>"; 

        //second
            $second = $myarr[1];  
          $phone_ = substr($second, 1, 10);       
           $status_ = substr($second, 11, strlen($second)); 
           echo "cell no. " .$phone_      ;
           echo "<br>";
           echo "cell status. " .$status_      ;

                 $sql = "UPDATE vehicle_csv SET status = $status_ WHERE phone  = $phone_";
                 $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo  $conn->connect_error;
                    }echo "<br>"; 
          //third
            $third = $myarr[2];
           $phone_ = substr($third, 1, 10);       
           $status_ = substr($third, 11, strlen($third)); 
           echo "cell no. " .$phone_      ;
           echo "<br>";
           echo "cell status. " .$status_      ;

                 $sql = "UPDATE vehicle_csv SET status = $status_ WHERE phone  = $phone_";
                 $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo  $conn->connect_error;
                    }echo "<br>"; 
              //four
            $fouth = $myarr[3];
           $phone_ = substr($fouth, 1, 10);       
           $status_ = substr($fouth, 11, strlen($fouth)); 
           echo "cell no. " .$phone_      ;
           echo "<br>";
           echo "cell status. " .$status_      ;

                 $sql = "UPDATE vehicle_csv SET status = $status_ WHERE phone  = $phone_";
                 $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo  $conn->connect_error;
                    } 
        }

     function next_($conn){

        $id = 1;
        $number= '';
        $phone= '';
       // if ()
        $ses = '';

    $var = $_GET['id'];
    echo "current id ";echo $var; echo "<br>";

         for ($i = 0; $i < 4; $i++){

            $sqlSelect = "SELECT * FROM vehicle_csv WHERE userId  = $var";
            $result = mysqli_query($conn, $sqlSelect);

            $row = mysqli_fetch_array($result);
                $number = $row['phone'];
            
            $var++;
         
            $isVal =  strlen($number);
                if ($isVal > 8 && $isVal < 10){  
                    $phone .= 0 ;
                    $phone .= $number ;
                }
                else {
                    echo "wrong".$number;  echo "<br>";
                }
            
            }
       
                
             echo "<br>";
            echo $phone;
            echo "<br>";
            $_SESSION['last_id'] = $var;
            echo $var;
        $number = '';
        $phone = '';
}


/*
 * 
 * response from gsm_shield will come in the form of get request but key value pair 
 * like 0209455482  1, 0241855238 0,
 * now i want to read it into an array and fetch it at the front
 * echo front_view   return data, var phone = substring(data), var status = substring(data)
 * where id is phone id  = this id, html(status)
 * 
 * http://brichghana.com/app.bvs.airtimebot/airtimeBot/get_april.php?gsm_status=green&value=0277738371%201,0505590847%201,0243574342%201,0541226767%201,0209455482%201&id=17
 * 
 */

