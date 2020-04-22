<?php

//import.php

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);

session_start();

if(isset($_SESSION['csv_file_name'])) {
$connect = new PDO("mysql:host=localhost; dbname=TuaTuaGye Data", "vxkgn0fmfwww", ">##e(a}T%5P");

 $file_data = fopen('uploaded_files/' . $_SESSION['csv_file_name'], 'r');

 fgetcsv($file_data);

 while($row = fgetcsv($file_data)){
  $data = array(
   ':first_name' => $row[0],
   ':last_name' => $row[1],
   ':third' => $row[2],
   ':four' => $row[3],
     ':five' => $row[4],
  );

  $query = "
  INSERT INTO vehicle_csv (userId, userName, car_num,phone, status) 
     VALUES (:first_name, :last_name, :third, :four, :five) ";

  $statement = $connect->prepare($query);

  $statement->execute($data);

  sleep(1);

  if(ob_get_level() > 0)
  {
   ob_end_flush();
  }
 }

 unset($_SESSION['csv_file_name']);
}
