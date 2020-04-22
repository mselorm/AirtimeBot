<?php

$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");
/*
$record_per_page = 70;
$page = '';
$output = '';


if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = 3;
}

$start_from = ($page - 1) * $record_per_page;

*/

if(isset($_POST['read'])){
$sqlSelect = "SELECT * FROM vehicle_csv";
$result = mysqli_query($conn, $sqlSelect);

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
            
if (mysqli_num_rows($result) > 0) {   //vehicle_csv (userId,userName,car_num,phone,status)

        while ($row = mysqli_fetch_array($result)) {
            $output .= '
           <tr>
                 <td>' . $row["userId"] . '</td>
                <td>' . $row["userName"] . '</td>
                <td>' . $row["phone_number"] . '</td>
                <td>' . $row["phone"] . '</td>
                <td>' . $row["status"] . '</td>
                <td>' . $row["time"] . '</td>
                             
      ';
        }
}
            echo $output;
        }

/*

$output .= '</table><br /><div align="center">';
$page_query = "SELECT * FROM signups  ORDER BY id DESC";
$page_result = mysqli_query($connect, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records / $record_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= "<span class='pagination_link page-item' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='" . $i . "'>" . $i . "</span>";
}

*/