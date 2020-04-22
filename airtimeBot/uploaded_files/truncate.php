<?php

//include_once '../upload.php';

/***************************************/
// insert csv data into vehicle_csv table 
/*******************************/

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");



//if (isset($_SESSION['csv_file_name'])) {
$conn = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");



    
        $sqlInsert = " TRUNCATE TABLE vehicle_csv;";
        $result = mysqli_query($conn, $sqlInsert);

        if (!empty($result)) {
            $type = "success";
           
        } else {
            $type = "error";
           // echo "Problem in Importing CSV Data";
        }
    


if ($type === 'success'){
    echo '<script type="text/javascript">
   console.log("vehicle_csv table truncated successfully");
</script>';
}

else {
    echo '<script type="text/javascript">
   console.log("failed truncated");
</script>';
}