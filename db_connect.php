<?php
$host = "sql211.infinityfree.com";
$user = "if0_43403456";
$pass = "tnaGGoamW0";
$dbname = "if0_43403456_esclada_orders";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>