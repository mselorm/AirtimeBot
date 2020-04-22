<?php


$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");
// required headers
// required headers
//header("Access-Control-Allow-Origin: brichghana.com");
//header("Content-Type: application/json; charset=UTF-8");

//include_once 'airtimeBot_Data.php';

/******************** */
//declarations
/******************** */

$BuyAirtime_isTrue = False;
$isON              = False;
$airtimeBalance    = 0.0;


$sendAirtime_isTrue = 'false';
if (isset($_GET['isData'])) {
    http_response_code(200);

    $sendAirtime_isTrue   = ""
;


    if ($sendAirtime_isTrue === "") {

      $details = mysqli_query($connect, "SELECT * FROM vehicle_sec WHERE value = 'value'");


    //  $details = mysqli_query($con,"SELECT * FROM signups");

    while ($row = mysqli_fetch_array($details)) {


        $update_ = ' 
            
                    Submission successful..! <br>
                    <table class="tablefocus">
   <tr>

   <td id="focus_1">' . $row['value'] . '</td>
   <td id="focus_1">' . $row['phone'] . '</td>
   <td id="focus_1">' . $row['phone_number'] . '</td>
   </tr>  <br><br><br><br>
  
';
    }  ///*else echo "1.0,0558859382,0546719139,0549803949,0550427231,0550466880,0593718387,0593718877*/
 
    
    echo $update_;
    }   else echo "no update ";
   
}    
        $notification = 'false';



