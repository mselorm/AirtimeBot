<?php

//import.php

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);
$output = '';
session_start();

if (isset($_SESSION['csv_file_name'])) {
$conn = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");


    $uploadFileDir =  './uploaded_files/';
    $_upfile = "744923571.csv";

    $dest_path = $uploadFileDir . $_upfile;

    $file_data = fopen($_SESSION['csv_file_name'], 'r');


       while ($row = fgetcsv($file_data, 50000, ",")) {
        $sqlInsert = "INSERT into vehicle_csv (userId,userName,car_num,phone,status)
                   values ('" .$row[0] . "','" .$row[1] . "','" .$row[2] . "','" .$row[3] . "','" .$row[4] . "')";
        $result = mysqli_query($conn, $sqlInsert);

        if (!empty($result)) {
            $type = "success";
            $message = "CSV Data Imported into the Database";
        } else {
            $type = "error";
            $message = "Problem in Importing CSV Data";
        }
    }


        //echo $output;
    }




