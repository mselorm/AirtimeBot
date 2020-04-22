<?php

//process.php  $connect = mysqli_connect("localhost", "vxkgn0fmfwww", ">##e(a}T%5P", "TuaTuaGye Data");

$connect = new PDO("mysql:host=localhost; dbname=TuaTuaGye Data", "vxkgn0fmfwww", ">##e(a}T%5P");

$query = "SELECT * FROM vehicle_csv";

$statement = $connect->prepare($query);

$statement->execute();

echo $statement->rowCount();

?>