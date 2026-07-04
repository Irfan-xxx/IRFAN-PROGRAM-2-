<?php

$host="localhost";
$user="root";
$pass="";
$db="db_paspor";

$conn=mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Koneksi gagal");
}

?>