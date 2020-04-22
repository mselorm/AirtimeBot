<?php

$connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

    $record_per_page = 70;
    $page = '';
    $output = '';


    if (isset($_POST["page"])) {
        $page = $_POST["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $record_per_page;
    $query = "SELECT * FROM vehicle_csv ORDER BY userId LIMIT $start_from, $record_per_page";
    $result = mysqli_query($connect, $query);
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
                                        <span class="custom-checkbox">
                                          <input type="checkbox" id="selectAll">
                                          <label for="selectAll"></label>
                                        </span>
                                      <th>
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

while ($row = mysqli_fetch_array($result)) {
    $output .= '
           <tr>         <td>
                        <span class="custom-checkbox">
                         <input type="checkbox" id="checkbox1">
                        <label for="selectAll"></label>
                         </span>      <td>
                 <td>' . $row["userId"] . '</td>
                <td>' . $row["userName"] . '</td>
                <td>' . $row["car_num"] . '</td>
                <td>' . $row["phone"] . '</td>
                <td>' . $row["status"] . '</td>
              
                             
      ';
}
$output .= '</table><br /><div align="center">';
$page_query = "SELECT * FROM vehicle_csv  ORDER BY userId ";
$page_result = mysqli_query($connect, $page_query);
$total_records = mysqli_num_rows($page_result);
$total_pages = ceil($total_records / $record_per_page);
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= "<span class='pagination_link page-item' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='" . $i . "'>" . $i . "</span>";
}


$output .= '</div><br /><br />';
echo $output;

            /*
          <nav aria-label="...">
              <ul class="pagination">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                  <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>

                */