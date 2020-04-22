<?php

//import.php

header('Content-type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

set_time_limit(0);

ob_implicit_flush(1);

session_start();

if (isset($_SESSION['csv_file_name'])) {
    $connect = new PDO("mysql:host=localhost; dbname=TuaTuaGye Data", "vxkgn0fmfwww", ">##e(a}T%5P");

    $uploadFileDir =  './uploaded_files/';
     $_upfile = "682946156.csv";

    $dest_path = $uploadFileDir . $_upfile;

    $file_data = fopen("$dest_path", 'r');
/*
    $file_data = fopen('uploaded_files/' . $_SESSION['csv_file_name'], 'r');
*/
   // fgetcsv($file_data);
     
    while ($row = fgetcsv($file_data, 10000, ",")) {
        $data = array(
            $first_name => $row[0],
            $last_name => $row[1],
            $third => $row[2],
            $four => $row[3],
            $five => $row[4],


        );


        /*
        $query = "
  INSERT INTO vehicle_csv (userId, userName, car_num,phone, status) 
     VALUES (:first_name, :last_name, :third, :four, :five) ";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        sleep(1);

        if (ob_get_level() > 0) {
            ob_end_flush();
        }

        */


        $output .= '


            <div class="table-result">
                    <div class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header card-header-primary" style=" background: orange;">
                                <h4 class="card-title " style=" color:white">Phone Numbers</h4>
                                <p class="card-category" style=" color:white"> Only numbers here can recieve airtime bundle</p>
                              </div>
                              <div class="card-body">
                                <div class="table-responsive">
                                  <table class="table">
                                    <thead class=" text-primary">
                                      <th>
                                        ID
                                      </th>
                                      <th>
                                        Name
                                      </th>
                                     
                                      <th>
                                        Phone
                                      </th>
                                       <th>
                                        Car Number
                                      </th>
                                      <th>
                                        Status
                                      </th>
                                       <th>
                                        Time
                                      </th>
                                    </thead>';

   
                $output .= '
           <tr>
                 <td>' . $first_name . '</td>
                <td>' . $last_name . '</td>
                <td>' . $third . '</td>
                <td>' . $four . '</td>
                <td>' . $five . '</td>
                <td>'. "time". '</td>
                             
      ';
            
      
        echo $output;

        echo "<br>";
       echo   $_SESSION['csv_file_name'];
    }


    

  //  unset($_SESSION['csv_file_name']);
}



        





