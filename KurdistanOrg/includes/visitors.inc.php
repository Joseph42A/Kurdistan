<?php

include 'dbh.inc.php';


// Unique ip (REMOTE_ADDR)
$ip = $_SERVER['REMOTE_ADDR'];
// echo $ip;
$query = "SELECT * FROM visitors WHERE ip = '$ip'";
$query_get_ip = mysqli_query($conn, $query);
if(mysqli_num_rows($query_get_ip) == 0){
    $query =mysqli_query($conn, "INSERT INTO visitors (ip) VALUES ('$ip')") ;
}else{
    
}