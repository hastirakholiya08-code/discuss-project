<?php
$host="localhost";
$username="root";
$password="";
$database="discuss";

$conn = new mysqli($host, $username, $password, $database);
if($conn->connect_error){
    die("not connection with DB". $conn->connect_error);
}

?>