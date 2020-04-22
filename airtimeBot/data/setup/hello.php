<?php
$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

echo '
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
                                        Car Number
                                      </th>
                                      <th>
                                        Phone
                                      </th>
                                      <th>
                                        Status
                                      </th>
                                    </thead>
                                    ';
    $details = mysqli_query($connect, "SELECT * FROM vehicle_csv");

       while($row = mysqli_fetch_array($details)){
echo '
                                    
                                          <tr>
                 <td>' . $row["userId"] . '</td>
                <td>' . $row["userName"] . '</td>
                <td>' . $row["car_num"] . '</td>
                <td>' . $row["phone"] . '</td>
                <td>' . $row["status"] . '</td>
                                    ';
       
       }