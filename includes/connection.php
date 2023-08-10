<?php

$con = mysqli_connect("localhost", "root", "", "test-3");

if(mysqli_connect_errno()){
echo "connection error";
mysqli_connect_error();
exit();
}

?>