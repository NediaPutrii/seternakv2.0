<?php
$host = "localhost";
$dbname = "seternak2";
$user = "postgres";
$port = "5433";
$password = "12345678";
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);  


// $host = "localhost";
// $user = "postgres";
// $pass = "12345678";
// $port = "5433";
// $dbname = "seternak2";
// $dbconn = pg_connect("host=".$host." port=".$port." dbname=".$dbname." user=".$user." password=".$pass) or die("Gagal");
?>