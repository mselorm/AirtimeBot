<?php

$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

//http://brichghana.com/app.bvs.airtimebot/airtimeBot/db.php?phonum=hi&page=value&phone=11111
$map = 0;

if (isset($_GET["value"])) {
    $value = $_GET["value"];
    $phone = $_GET["phone"];
    $phonum = $_GET["phonum"];


    $my_file_update = fopen("arduino.text", "w");
    fwrite($my_file_update, $value);
    fclose($my_file_update);

    $my_file_update1 = fopen("arduino1.text", "w");
    fwrite($my_file_update1, $phone);
    fclose($my_file_update1);

    $my_file_update2 = fopen("arduino2.text", "w");
    fwrite($my_file_update2, $phonum);
    fclose($my_file_update2);


    echo "sa pa se !";
}




/**********************************************************/
//insert data into db
/*******************************************************/

// query to insert record
$query = "INSERT INTO vehicle_sec SET value=$value, phonum=$phonum ,phone=$phone";

// prepare query
//    $stmt = $connect->prepare($query);

/*
if (mysqli_query($connect, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connect);
}


/*******************************************************/


/*
//if data insertion fails

if ($map == 0) {

    //$details = mysqli_query($connect, "SELECT * FROM vehicle_sec WHERE page = '$value'");
    //uncomment this part if u want to debug this script
    /*
    //  $details = mysqli_query($con,"SELECT * FROM signups");

    while ($row = mysqli_fetch_array($details)) {


        $update_ = ' 
            
                    Submission successful..! <br>
                    <table class="tablefocus">
   <tr>
   <td id="focus_">CustomerID</td>
   <td id="focus_1">' . $row['page'] . '</td>
   <td id="focus_1">' . $row['phone'] . '</td>
   <td id="focus_1">' . $row['phone_number'] . '</td>
   </tr>
  
';  }*/

    // echo $update_;
 /*   echo "data inserted successfully";
} else
    echo "italy data insert didn;t work";
*/