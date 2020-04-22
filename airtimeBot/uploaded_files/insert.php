<?php

include_once './truncate.php';

/***************************************/
// insert csv data into vehicle_csv table 
/*******************************/

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);
$output = '';
session_start();

//if (isset($_SESSION['csv_file_name'])) {
$conn = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

echo "ready to fetch csv file content";
    $uploadFileDir =  './uploaded_files/';
    $_upfile = "744923571.csv";  



    $dest_path = $uploadFileDir . $_upfile;

    //$file_data = fopen( $_SESSION['csv_file_name'], 'r');
    
        $file_data = fopen('37928310.csv', 'r');


       while ($row = fgetcsv($file_data, 10000, ",")) {
        $sqlInsert = "INSERT into vehicle_csv (car_num,  userName, phone)
                   values ('" .$row[0] . "','" .$row[5] . "','" .$row[6] . "')";
        $result = mysqli_query($conn, $sqlInsert);

        if (!empty($result)) {
            $type = "success";
            echo "CSV Data Imported into the Database";
        } else {
            $type = "error";
            echo "Problem in Importing CSV Data";
        }
    }


        //echo $output;
  //  }

//else echo "csv file note found";

