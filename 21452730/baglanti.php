<?php 

$host="localhost";
$kullanicilar="root";
$parola="";
$vt="uyeliik";

$baglanti = mysqli_connect($host,$kullanicilar,$parola,$vt);
mysqli_set_charset($baglanti,"UTF8");



?>