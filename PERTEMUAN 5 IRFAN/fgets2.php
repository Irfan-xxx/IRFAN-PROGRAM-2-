<?php
$file = fopen("test1.txt", "r");
while (!feof($file)) {
    echo fgets($file) . "<br />";
}
fclose($file);
//Project 5.3 By M IRFAN APRIYANA - 221011450110
?>